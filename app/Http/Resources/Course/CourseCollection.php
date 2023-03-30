<?php

namespace App\Http\Resources\Course;

use App\Models\Course;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class CourseCollection extends ResourceCollection
{
    public function toArray($request): Collection
    {
        return $this->collection->transform(function (CourseResource $courseResource) {
            /** @var Course $course */
            $course = $courseResource->resource;

            return [
                'id' => $course->getId(),
                'name' => $course->getName(),
                'is_active' => $course->isActive(),
                'created_at' => $course->getCreatedAt(),
                'updated_at' => $course->getUpdatedAt(),
            ];
        });
    }
}
