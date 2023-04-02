<?php

namespace App\Models\Question;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Question.php
 * @package App\Models\Question
 *
 * @property int $id
 * @property int $question_id
 * @property string $answer
 * @property boolean $is_correct
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Answer extends Model
{
    protected $table = 'answers';
    protected $fillable = [
        'question_id',
        'answer',
        'deleted_at',
    ];

    public static function deletedQuery(): Builder
    {
        return parent::query()->whereNull('deleted_at');
    }

    public function insertItems(array $items): bool
    {
        return Answer::query()->insert($items);
    }

    public function updateItems(Collection $answers, array $items): bool
    {
        foreach ($items as $i => $item) {
            if (!$this->updateItem($answers[$i], $item)) {
                return false;
            }
        }

        return true;
    }

    public function updateItem(Answer $answer, array $item): bool
    {
        return $answer->update($item);
    }

    public function destroyItems(int $questionId): int
    {
        return Answer::deletedQuery()
            ->where('question_id', '=', $questionId)
            ->update(['deleted_at' => date('Y-m-d H:i:s')]);
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
    public function getQuestionId(): int
    {
        return $this->question_id;
    }

    /**
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->answer;
    }

    /**
     * @return bool
     */
    public function isCorrect(): bool
    {
        return $this->is_correct;
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

    /**
     * @return string
     */
    public function getDeletedAt(): string
    {
        return $this->deleted_at;
    }

    // Instance

    public static function getInstance(): Answer
    {
        return new static();
    }
}
