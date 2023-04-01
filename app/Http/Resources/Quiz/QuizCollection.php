<?php

namespace App\Http\Resources\Quiz;

use App\Models\Quiz;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class QuizCollection extends ResourceCollection
{
    public function toArray($request): Collection
    {
        return $this->collection->transform(function (QuizResource $quizResource) {
            /** @var Quiz $quiz */
            $quiz = $quizResource->resource;

            return [
                'id' => $quiz->getId(),
                'name' => $quiz->getName(),
                'course' => $quiz->getCourseName(),
                'lesson' => $quiz->getLessonName(),
                'is_active' => $quiz->isActive(),
            ];
        });
    }
}
