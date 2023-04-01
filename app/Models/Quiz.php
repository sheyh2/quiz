<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Quiz.php
 * @package App\Models
 *
 * @property int $id
 * @property int $lesson_id
 * @property string $name
 * @property int $expired_time
 * @property bool $is_active
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Lesson $lesson
 */
class Quiz extends Model
{
    protected $table = 'quizzes';
    protected $fillable = [
        'lesson_id',
        'name',
        'expired_time',
        'is_active',
    ];

    public function paginate(int $items = 18, array $filter = []): LengthAwarePaginator
    {
        $quizQuery = Quiz::query()->with('lesson')
            ->join('lessons', 'lessons.id', '=', 'quizzes.lesson_id')
            ->join('courses', 'courses.id', '=', 'lessons.course_id');

        if (isset($filter['courseId'])) {
            $quizQuery = $quizQuery->where('courses.id', '=', $filter['courseId']);
        }

        if (isset($filter['lessonId'])) {
            $quizQuery = $quizQuery->where('lessons.id', '=', $filter['lessonId']);
        }

        return $quizQuery
            ->orderBy('quizzes.id')
            ->distinct()
            ->select('quizzes.*')
            ->paginate($items);
    }

    public function getById(int $id)
    {
        return Quiz::query()
            ->whereKey($id)
            ->first();
    }

    public function insertItem(array  $items)
    {
        return Quiz::query()->create($items);
    }

    public function updateItem(Quiz $quiz, array  $items): bool
    {
        return $quiz->update($items);
    }

    // Relations

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class, 'lesson_id', 'id');
    }

    // Getters

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getLessonId(): int
    {
        return $this->lesson_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function getLessonName(): ?string
    {
        if (is_null($this->lesson)) {
            return null;
        }

        return $this->lesson->getName();
    }

    public function getCourseName(): ?string
    {
        if (is_null($this->lesson) || is_null($this->lesson->course)) {
            return null;
        }

        return $this->lesson->course->getName();
    }

    /**
     * @return int
     */
    public function getExpiredTime(): int
    {
        return $this->expired_time;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    public static function getInstance(): Quiz
    {
        return new static();
    }
}
