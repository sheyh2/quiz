<?php

namespace App\Http\Resources\File;

use App\Models\File;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class FileCollection extends ResourceCollection
{
    public function toArray($request): Collection
    {
        return $this->collection->transform(function (FileResource $fileResource) {
            /** @var File $file */
            $file = $fileResource->resource;

            return [
                'id' => $file->getId(),
                'name' => $file->getName(),
                'extension' => $file->getExtension(),
                'url' => $file->getUrl(),
            ];
        });
    }
}
