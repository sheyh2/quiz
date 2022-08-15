<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;

/**
 * Class Science
 * @package App\Models\Science
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Collection $files
 */
class Science extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    /**
     * @return MorphMany
     */
    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
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
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }

    /**
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon
    {
        return $this->updated_at;
    }

    /**
     * @param string $slug
     * @return Science
     */
    public function getBySlug(string $slug): Science
    {
        /** @var Science|null $science */
        $science = Science::query()
            ->where('slug','=', $slug)
            ->first();

        if (is_null($science)) {
            throw new \RuntimeException('Предмет не найден');
        }

        return $science;
    }
}
