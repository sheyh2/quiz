<?php

namespace App\Http\Resources\Question;

use App\Models\Question\Question;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var Question $question */
        $question = $this->resource;

        return [
            'id' => $question->getId(),
            'question' => $question->getQuestion(),
            'answers' => new AnswerCollection($question->answers)
        ];
    }
}
