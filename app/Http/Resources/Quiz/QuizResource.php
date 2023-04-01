<?php

namespace App\Http\Resources\Quiz;

use App\Models\Quiz;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var Quiz $quiz */
        $quiz = $this->resource;

        return [
            'id' => $quiz->getId(),
            'name' => $quiz->getName(),
        ];
    }
}
