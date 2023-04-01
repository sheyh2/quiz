<?php

namespace App\Http\Resources\Course;

use App\Models\Course;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var Course $course */
        $course = $this->resource;

        return [
            'id' => $course->getId(),
            'name' => $course->getName(),
            'created_at' => $course->getCreatedAt(),
            'updated_at' => $course->getUpdatedAt(),
        ];
    }
}
