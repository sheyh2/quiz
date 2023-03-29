<?php

namespace App\Core\Cache;

use Illuminate\Support\Facades\Cache;

/**
 * Class AbstractCache.php
 *
 * @package App\Core\Cache
 * @nickname <sheyh2>
 * @author Abdurakhmon Abdusharipov <abdusharipov.sheyx@gmail.com>
 *
 * Date: 18/01/23
 */
class AbstractCache implements CacheInterface
{
    public $minute = 60;
    public $hour = 3600;
    public $day = 86400;

    public function put(string $key, $value, int $ttl)
    {
        Cache::put($key, $value, $ttl);
    }

    public function get(string $key)
    {
        return Cache::get($key);
    }

    /**
     * @param string $key
     * @return bool
     */
    public function forget(string $key): bool
    {
        return Cache::forget($key);
    }
}
