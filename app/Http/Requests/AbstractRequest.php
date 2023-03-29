<?php

namespace App\Http\Requests;

use App\Core\Base\ConstKeys;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

/**
 * Class AbstractRequest.php
 *
 * @package App\Http\Requests
 * @nickname <sheyh2>
 * @author Abdurakhmon Abdusharipov <abdusharipov.sheyx@gmail.com>
 *
 * Date: 29/03/23
 */
class AbstractRequest extends FormRequest
{
    /**
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            new JsonResponse([
                ConstKeys::STATUS => false,
                ConstKeys::CODE => 422,
                ConstKeys::ERRORS => $validator->errors()->all(),ConstKeys::DATA => [],
            ], 422)
        );
    }
}
