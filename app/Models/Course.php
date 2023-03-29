<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

/**
 * class Course.php
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property bool $is_active
 * @property string $created_at
 * @property string $updated_at
 */
class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = [
        'name',
        'is_active',
    ];

    public function paginate(int $perPage = 18): LengthAwarePaginator
    {
        return Course::query()
            ->orderByDesc('id')
            ->paginate($perPage);
    }

    public function getById(int $id)
    {
        return Course::query()
            ->whereKey($id)
            ->first();
    }

    public function store(array $items)
    {
        return Course::query()->create($items);
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
