<?php

namespace App\Http\Resources\File;

use App\Models\File;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var File $file */
        $file = $this->resource;

        return [
            'id' => $file->getId(),
            'name' => $file->getName(),
            'extension' => $file->getExtension(),
            'url' => $file->getUrl(),
        ];
    }
}
