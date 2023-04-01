<?php

namespace App\Http\Resources\Quiz;

use App\Models\Quiz;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Quiz $quiz */
        $quiz = $this->resource;

        return [
            'id' => $quiz->getId(),
            'name' => $quiz->getName(),
            'course' => $quiz->getCourseName(),
            'lesson' => $quiz->getLessonName(),
            'create_at' => $quiz->getCreatedAt(),
            'updated_at' => $quiz->getUpdatedAt(),
        ];
    }
}
