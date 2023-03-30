<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * class Lesson.php
 * @package App\Models
 *
 * @property int $id
 * @property int $course_id
 * @property string $name
 * @property bool $is_active
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Collection $files
 */
class Lesson extends Model
{
    protected $table = 'lessons';
    protected $fillable = [
        'course_id',
        'name',
        'is_active',
    ];

    public function paginate(int $items = 18, array $filter = []): LengthAwarePaginator
    {
        $lessonQuery = Lesson::query()->with('files');

        if (isset($filter['courseId'])) {
            $lessonQuery->where('course_id', '=', $filter['courseId']);
        }

        return $lessonQuery
            ->orderBy('id')
            ->paginate($items);
    }

    public function getById(int $id)
    {
        return Lesson::query()
            ->whereKey($id)
            ->first();
    }

    public function store(array $items)
    {
        return Lesson::query()->create($items);
    }

    public function duplicate(int $courseId, string $name)
    {
        return Lesson::query()
            ->where('course_id', '=', $courseId)
            ->where('name', '=', $name)
            ->exists();
    }

    // Relations

    public function files(): HasMany
    {
        return $this->hasMany(File::class, 'fileable_id', 'id')
            ->where('fileable_type', '=', 'lesson');
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
    public function getCourseId(): int
    {
        return $this->course_id;
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

    public static function getInstance(): Lesson
    {
        return new static();
    }
}
