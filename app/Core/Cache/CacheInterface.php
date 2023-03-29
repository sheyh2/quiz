<?php

namespace App\Core\Cache;

interface CacheInterface
{
    public function put(string $key, $value, int $ttl);
    public function get(string $key);
    public function forget(string $key);
}
