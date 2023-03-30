<?php

namespace App\Http\Requests\File;

use App\Http\Requests\AbstractRequest;

class StoreRequest extends AbstractRequest
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
            'fileableId' => 'required',
            'fileableType' => 'required',
            'file' => 'required|mimes:pdf,docx,xlsx,pptx,png',
        ];
    }
}
