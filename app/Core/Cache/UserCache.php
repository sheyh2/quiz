<?php

namespace App\Core\Cache;

use App\Models\User;

/**
 * Class UserCache.php
 *
 * @package App\Core\Cache
 * @nickname <sheyh2>
 * @author Abdurakhmon Abdusharipov <abdusharipov.sheyx@gmail.com>
 *
 * Date: 27/03/23
 */
class UserCache extends AbstractCache
{
    public function getUser(?string $token): ?User
    {
        if (is_null($token)) {
            return null;
        }

        $user = $this->get($token);

        if (is_null($user)) {
            $user = User::getInstance()->getUserByToken($token);
        }

        return $user;
    }

    public static function getInstance(): UserCache
    {
        return new static();
    }
}
