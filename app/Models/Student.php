<?php

namespace App\Models;

use App\Models\Result\Result;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Student.php
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property boolean $is_blocked
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Result $result
 */
class Student extends Model
{
    protected $table = 'students';
    protected $fillable = [
        'name',
        'surname',
        'email',
        'is_blocked',
    ];

    public function paginate(int $items, array $filter): LengthAwarePaginator
    {
        $studentQuery = Student::query();

        if (isset($filter['name'])) {
            $studentQuery = $studentQuery
                ->where('name', 'like', '%'.$filter['name'].'%')
                ->orWhere('surname', 'like', '%'.$filter['name'].'%');
        }

        return $studentQuery
            ->orderBy('id')
            ->paginate($items);
    }

    public function getById(int $id)
    {
        return Student::query()
            ->whereKey($id)
            ->first();
    }

    // Relations

    public function result(): HasOne
    {
        return $this->hasOne(Result::class, 'student_id', 'id')->orderByDesc('id');
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return bool
     */
    public function isBlocked(): bool
    {
        return $this->is_blocked;
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

    public static function getInstance(): Student
    {
        return new static();
    }
}
