<?php

namespace App\Http\Resources\Course;

use App\Models\Course;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class CourseCollection extends ResourceCollection
{
    /**
     * @param $request
     * @return Collection
     */
    public function toArray($request)
    {
        return $this->collection->transform(function (CourseResource $courseResource) {
            /** @var Course $course */
            $course = $courseResource->resource;

            return [
                'id' => $course->getId(),
                'name' => $course->getName(),
                'is_active' => $course->isActive(),
            ];
        });
    }
}
