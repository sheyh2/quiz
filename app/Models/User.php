<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * class USer.php
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $password
 * @property string $token
 * @property bool $status
 * @property string $created_at
 * @property string $updated_at
 */
class User extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'token',
        'status',
    ];

    protected $hidden = [
        'password',
        'token',
    ];

    public static function query(): Builder
    {
        return parent::query()
            ->where('status', '=', true);
    }

    public function getUserByToken(string $token)
    {
        return User::query()
            ->where('token', '=', $token)
            ->first();
    }

    public function getUser(string $email)
    {
        return User::query()
            ->where('email', '=', $email)
            ->first();
    }

    public function create(array $items)
    {
        return User::query()->create($items);
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
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
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

    public static function getInstance(): User
    {
        return new static();
    }
}
