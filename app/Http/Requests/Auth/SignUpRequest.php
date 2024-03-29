<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\AbstractRequest;

class SignUpRequest extends AbstractRequest
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
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|max:255|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ];
    }
}
