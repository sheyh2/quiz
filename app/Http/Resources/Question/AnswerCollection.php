<?php

namespace App\Http\Resources\Question;

use App\Models\Question\Answer;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class AnswerCollection extends ResourceCollection
{
    public function toArray($request): Collection
    {

        return $this->collection->transform(function ($answer) {
            return [
                'id' => $answer->getId(),
                'answer' => $answer->getAnswer(),
                'is_correct' => $answer->isCorrect()
            ];
        });
    }
}
