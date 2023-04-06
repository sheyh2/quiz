<?php

namespace App\Http\Requests\Quiz;

use App\Http\Requests\AbstractRequest;

class ActionRequest extends AbstractRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lesson_id' => 'required',
            'name' => 'required',
            'expired_time' => 'required',
        ];
    }
}
