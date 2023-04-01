<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File as FileFacades;

/**
 * Class File.php
 * @package App\Models
 *
 * @property int $id
 * @property int $fileable_id
 * @property string $fileable_type
 * @property string $path
 * @property string $name
 * @property string $extension
 * @property string $md5
 * @property string $created_at
 * @property string $updated_at
 */
class File extends Model
{
    protected $table = 'files';
    protected $fillable = [
        'fileable_id',
        'fileable_type',
        'path',
        'name',
        'extension',
        'md5',
    ];

    public function list(array $data)
    {
        return File::query()
            ->where('fileable_type', '=', $data['fileableType'])
            ->where('fileable_id', '=', $data['fileableId'])
            ->get();
    }

    public function getById(int $id)
    {
        return File::query()
            ->whereKey($id)
            ->first();
    }

    public function insertItem(array $items)
    {
        return File::query()->create($items);
    }

    public function destroyItem(File $file)
    {
        if ($this->remove($file)) {
            $file->delete();
        }
    }

    public function destroyItems(Collection $files)
    {
        /** @var File $file */
        foreach ($files as $file) {
            $this->destroyItem($file);
        }
    }

    public function move(UploadedFile $uploadedFile, File $file)
    {
        if (!FileFacades::exists($file->getPublicPath())) {
            FileFacades::makeDirectory($file->getPath(), 0777, true, true);
        }

        $uploadedFile->move($file->getPath(), $file->getName().'.'.$file->getExtension());
    }

    public function remove(File $file): bool
    {
        if (FileFacades::exists($file->getPublicPath())) {
            return unlink($file->getPublicPath());
        }

        return true;
    }

    // Getters

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getFileableId(): int
    {
        return $this->fileable_id;
    }

    /**
     * @return string
     */
    public function getFileableType(): string
    {
        return $this->fileable_type;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @return string
     */
    public function getMd5(): string
    {
        return $this->md5;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    public function getUrl(): string
    {
        return asset($this->getPublicPath());
    }

    public function getAbsolutPath(): string
    {
        return public_path($this->getPublicPath());
    }

    public function getPublicPath(): string
    {
        return $this->getPath().'/'.$this->getName().'.'.$this->getExtension();
    }

    // Instance

    public function getInstance(): File
    {
        return new static();
    }
}
