<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * class Course.php
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property bool $is_active
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Collection $lessons
 */
class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = [
        'name',
        'is_active',
    ];

    public function paginate(int $perPage = 18, array $filter = []): LengthAwarePaginator
    {
        $courseQuery = Course::query();

        if (isset($filter['name'])) {
            $courseQuery = $courseQuery->where('name', 'ilike', '%'.$filter['name'].'%');
        }

        return $courseQuery
            ->orderByDesc('id')
            ->paginate($perPage);
    }

    public function getById(int $id)
    {
        return Course::query()
            ->whereKey($id)
            ->first();
    }

    public function insertItem(array $items)
    {
        return Course::query()->create($items);
    }

    public function updateItem(Course $course, array $items): bool
    {
        return $course->update($items);
    }

    // Related

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class, 'course_id', 'id');
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

    // Instance

    public static function getInstance(): Course
    {
        return new static();
    }
}
