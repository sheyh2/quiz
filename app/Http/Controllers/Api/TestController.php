<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestList;
use App\Models\Test;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TestController extends AbstractApiController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $tests = Test::query()
                ->inRandomOrder()
                ->paginate(
                    20,
                    ['*'],
                    'page',
                    (int)$request->query('page') === 0 ? 1 : (int)$request->query('page')
                );

            return self::renderJson(
                new TestList($tests)
            );
        } catch (Exception $exception) {
            return self::renderJson(
                [],
                $exception->getMessage(),
                $exception->getCode() === 0 ? 400 : $exception->getCode(),
                false
            );
        }
    }
}
