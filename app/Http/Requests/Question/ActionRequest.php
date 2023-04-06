<?php

namespace App\Http\Requests\Question;

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
            'quiz_id' => 'required',
            'question' => 'required',
            'answers' => 'required|array|min:2'
        ];
    }
}
