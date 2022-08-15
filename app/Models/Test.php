<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Test
 * @package App\Models\Test
 *
 * @property int $id
 * @property int $science_id
 * @property string $question
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Collection $answers
 */
class Test extends Model
{
    protected $fillable = [
        'question',
    ];

    /**
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class, 'test_id', 'id')
            ->inRandomOrder();
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
    public function getScienceId(): int
    {
        return $this->science_id;
    }

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @return int
     */
    public function getCreatedAt(): int
    {
        return $this->created_at;
    }

    /**
     * @return int
     */
    public function getUpdatedAt(): int
    {
        return $this->updated_at;
    }
}
