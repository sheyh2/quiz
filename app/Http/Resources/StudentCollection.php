<?php

namespace App\Http\Resources;

use App\Models\Student;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class StudentCollection extends ResourceCollection
{
    public function toArray($request): Collection
    {
        return $this->collection->transform(function (Student $student) {
            return [
                'id' => $student->getId(),
                'name' => $student->getName(),
                'surname' => $student->getSurname(),
                'email' => $student->getEmail(),
                'is_blocked' => $student->isBlocked(),
                'created_at' => $student->getCreatedAt(),
                'updated_at' => $student->getUpdatedAt(),
            ];
        });
    }
}
