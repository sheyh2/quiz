<?php

namespace App\Http\Middleware\Api;

use App\Core\Base\ConstKeys;
use App\Core\Cache\UserCache;
use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Authenticate
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (is_null(UserCache::getInstance()->getUser($request->bearerToken()))) {
            throw new HttpResponseException(new JsonResponse([
                ConstKeys::STATUS => false,
                ConstKeys::CODE => 401,
                ConstKeys::ERRORS => ['Unauthorized'],
                ConstKeys::CONTENT => []
            ], 401));
        }

        return $next($request);
    }
}
