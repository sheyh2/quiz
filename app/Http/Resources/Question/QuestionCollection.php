<?php

namespace App\Http\Resources\Question;

use App\Models\Question\Question;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class QuestionCollection extends ResourceCollection
{
    public function toArray($request): Collection
    {
        return $this->collection->transform(function (QuestionResource $questionResource) {
            /** @var Question $question */
            $question = $questionResource->resource;

            return [
                'id' => $question->getId(),
                'question' => $question->getQuestion(),
                'answer_quantity' => $question->answers->count(),
                'created_at' => $question->getCreatedAt(),
                'updated_at' => $question->getUpdatedAt(),
            ];
        });
    }
}
