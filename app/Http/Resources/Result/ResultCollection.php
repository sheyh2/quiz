<?php

namespace App\Http\Resources\Result;

use App\Models\Student;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class ResultCollection extends ResourceCollection
{
    public function toArray($request): Collection
    {
        return $this->collection->transform(function (Student $student) {
            return [
                'id' => $student->getId(),
                'name' => $student->getName(),
                'surname' => $student->getSurname(),
                'email' => $student->getEmail(),
                'result' => $student->result->getResult(),
                'created_at' => $student->result->getCreatedAt(),
            ];
        });
    }
}
