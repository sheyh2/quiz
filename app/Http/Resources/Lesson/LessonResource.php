<?php

namespace App\Http\Resources\Lesson;

use App\Models\Lesson;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var Lesson $lesson */
        $lesson = $this->resource;

        return [
            'id' => $lesson->getId(),
            'name' => $lesson->getName(),
            'resources' => $lesson->files->count(),
            'created_at' => $lesson->getCreatedAt(),
            'updated_at' => $lesson->getUpdatedAt(),
        ];
    }
}
