<?php

namespace App\Http\Resources;

use App\Models\Test;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class TestList extends ResourceCollection
{
    /**
     * @param $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        /** @var LengthAwarePaginator $lengthAwarePaginator */
        $lengthAwarePaginator = $this->resource;

        return [
            'total'       => $lengthAwarePaginator->total(),
            'perPage'     => $lengthAwarePaginator->perPage(),
            'currentPage' => $lengthAwarePaginator->currentPage(),
            'lastPage'    => $lengthAwarePaginator->lastPage(),
            'list'        => $this->collection->transform(function (Test $test) {
                return [
                    'id'       => $test->getId(),
                    'question' => $test->getQuestion(),
                    'answers'  => new AnswerCollection($test->answers)
                ];
            })
        ];
    }
}
