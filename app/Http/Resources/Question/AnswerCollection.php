<?php

namespace App\Http\Resources\Question;

use App\Models\Question\Answer;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class AnswerCollection extends ResourceCollection
{
    public function toArray($request): Collection
    {
        return $this->collection->transform(function (Answer $answer) {
            return [
                'id' => $answer->getId(),
                'answer' => $answer->getAnswer(),
                'isCorrect' => $answer->isCorrect()
            ];
        });
    }
}