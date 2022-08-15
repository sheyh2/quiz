<?php

namespace App\Http\Resources;

use App\Models\Answer;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use JsonSerializable;

class AnswerCollection extends ResourceCollection
{
    /**
     * @param $request
     * @return Arrayable|Collection|JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->transform(function (Answer $answer) {
            return [
                'id'     => $answer->getId(),
                'answer' => $answer->getAnswer()
            ];
        });
    }
}
