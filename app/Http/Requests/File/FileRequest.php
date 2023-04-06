<?php

namespace App\Http\Requests\File;

use App\Http\Requests\AbstractRequest;

class FileRequest extends AbstractRequest
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
            'fileable_id' => 'required',
            'fileable_type' => 'required'
        ];
    }
}
