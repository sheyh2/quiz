<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class File
 * @package App\Models\File
 *
 * @property int $id
 * @property int $fileable_id
 * @property string $fileable_type
 * @property string $name
 * @property string $path
 * @property string $ext
 */
class File extends Model
{
    public $timestamps = false;

    /**
     * @return MorphTo
     */
    public function fileable(): MorphTo
    {
        return $this->morphTo();
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
    public function getName(): string
    {
        return $this->name;
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
    public function getExt(): string
    {
        return $this->ext;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return asset($this->getPath() . '/' . $this->getName() . '.' . $this->getExt());
    }

    /**
     * @return string
     */
    public function getPublicPath(): string
    {
        return public_path($this->getPath() . '/' . $this->getName() . '.' . $this->getExt());
    }
}
