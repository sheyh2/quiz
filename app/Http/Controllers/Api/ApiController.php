<?php

namespace App\Http\Controllers\Api;

use App\Core\Base\ConstKeys;
use App\Core\Cache\UserCache;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class ApiController
{
    public function __construct(Request $request)
    {
        $this->user = UserCache::getInstance()->getUser($request->bearerToken());
    }

    public $user;
    public $status = true;
    public $code = 200;
    public $message = 'ok';
    public $meta = null;

    /**
     * @param mixed $resource
     * @return JsonResponse
     */
    public function composeJson($resource = []): JsonResponse
    {
        $data = [
            ConstKeys::STATUS =>  $this->status,
            ConstKeys::CODE => $this->code,
        ];
        if ($this->code !== 200) {
            $data[ConstKeys::ERRORS] = [$this->message];
        } else {
            $data[ConstKeys::MESSAGE] = $this->message;
        }
        $data[ConstKeys::CONTENT] = $resource;
        $data[ConstKeys::PAGEABLE] = $this->meta;

        return new JsonResponse($data, $this->code);
    }
}
