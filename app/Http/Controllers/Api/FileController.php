<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\File\FileRequest;
use App\Http\Requests\File\StoreRequest;
use App\Http\Resources\File\FileCollection;
use App\Http\Resources\File\FileResource;
use App\Models\File;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class FileController extends ApiController
{
    private $paths = [
        'lesson' => 'uploads/file/lesson',
    ];

    public function getList(FileRequest $request)
    {
        $files = File::getInstance()->list($request->validated());

        return $this->composeJson(new FileCollection($files));
    }

    public function store(StoreRequest $request)
    {
        /** @var UploadedFile $uploadedFile */
        $uploadedFile = $request->file('file');

        try {
            DB::beginTransaction();

            /** @var File $file */
            $fileInstance = File::getInstance();
            $file = $fileInstance->insertItem([
                'fileable_id' => $request->input('fileableId'),
                'fileable_type' => $request->input('fileableType'),
                'path' => $this->paths[$request->input('fileableType')],
                'name' => uniqid($request->input('fileableType')),
                'extension' => $uploadedFile->getClientOriginalExtension(),
                'md5' => md5_file($uploadedFile),
            ]);
            $fileInstance->move($uploadedFile, $file);

            DB::commit();
            return $this->composeJson(new FileResource($file));
        } catch (Exception $exception) {
            DB::rollBack();

            $this->status = false;
            $this->code = 400;
            $this->message = $exception->getMessage();

            return $this->composeJson();

        }
    }

    public function destroy($id)
    {
        /** @var File|null $file */
        $fileInstance = File::getInstance();
        $file = $fileInstance->getById($id);

        if (is_null($file)) {
            $this->status = false;
            $this->code = 404;
            $this->message = 'File not found!';

            return $this->composeJson();
        }

        try {
            DB::beginTransaction();

            File::getInstance()->destroyItem($file);
            $file->delete();

            DB::commit();
            return $this->composeJson();
        } catch (Exception $exception) {
            $this->status = false;
            $this->code = 400;
            $this->message = $exception->getMessage();

            return $this->composeJson();
        }
    }
}
