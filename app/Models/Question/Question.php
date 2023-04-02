<?php

namespace App\Models\Question;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Question.php
 * @package App\Models\Question
 *
 * @property int $id
 * @property int $quiz_id
 * @property string $question
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 * @property Collection $answers
 */
class Question extends Model
{
    protected $table = 'questions';
    protected $fillable = [
        'quiz_id',
        'question',
        'deleted_at',
    ];

    public static function deletedQuery(): Builder
    {
        return parent::query()->whereNull('deleted_at');
    }

    // Related

    public function paginate(int $items = 18, array $filter = []): LengthAwarePaginator
    {
        $questionQuery = Question::deletedQuery();

        if (isset($filter['quizId'])) {
            $questionQuery = $questionQuery->where('quiz_id', '=', $filter['quizId']);
        }

        if (isset($filter['question'])) {
            $questionQuery = $questionQuery->where('question', 'like', '%'.$filter['question'].'%');
        }

        return $questionQuery
            ->orderBy('id')
            ->paginate($items);
    }

    public function getById(int $id)
    {
        return Question::deletedQuery()
            ->whereKey($id)
            ->first();
    }

    public function insertItem(array $items)
    {
        return Question::query()->create($items);
    }

    public function updateItem(Question $question, array $items): bool
    {
        return $question->update($items);
    }

    public function destroyItem(Question $question): ?bool
    {
        return $question->update(['deleted_at' => date('Y-m-d H:i:s')]);
    }

    // Related

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class, 'question_id', 'id');
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
    public function getQuizId(): int
    {
        return $this->quiz_id;
    }

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
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

    // Instance

    public static function getInstance(): Question
    {
        return new static();
    }
}
