<?php

namespace App\Http\Resources\Lesson;

use App\Models\Lesson;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class LessonCollection extends ResourceCollection
{
    /**
     * @param $request
     * @return Collection
     */
    public function toArray($request)
    {
        return $this->collection->transform(function (LessonResource $lessonResource) {
            /** @var Lesson $lesson */
            $lesson = $lessonResource->resource;

            return [
                'id' => $lesson->getId(),
                'name' => $lesson->getName(),
                'is_active' => $lesson->isActive(),
                'resources' => $lesson->files->count(),
                'created_at' => $lesson->getCreatedAt(),
                'updated_at' => $lesson->getUpdatedAt(),
            ];
        });
    }
}
