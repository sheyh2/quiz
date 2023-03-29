<?php

namespace App\Http\Controllers\Api;

use App\Core\Cache\UserCache;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController
{
    public function __construct(Request $request)
    {
        $this->user = UserCache::getInstance()->getUser($request->bearerToken());
    }

    public $user;
    public $status = true;
    public $code = 200;
    public $message = 'ok';

    /**
     * @param array $resource
     * @return JsonResponse
     */
    public function composeJson(array $resource = []): JsonResponse
    {
        $data = [
            'status' =>  $this->status,
            'code' => $this->code,
        ];
        if ($this->code !== 200) {
            $data['errors'] = [$this->message];
        }
        $data['data'] = $resource;

        return new JsonResponse($data, $this->code);
    }
}
