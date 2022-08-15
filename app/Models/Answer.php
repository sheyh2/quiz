<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Answer
 * @package App\Models\Answer
 *
 * @property int $id
 * @property int $test_id
 * @property string $answer
 * @property bool $is_correct
 */
class Answer extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'test_id',
        'answer',
        'is_correct'
    ];

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
    public function getTestId(): int
    {
        return $this->test_id;
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
    public function getIsCorrect(): bool
    {
        return $this->is_correct;
    }
}
