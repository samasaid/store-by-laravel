<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagsRequest extends FormRequest
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
            "name"=>"required|string",
            "slug"=>'required|unique:categories,slug,'.$this->id,
        ];
    }
    public function messages()
    {
        return [
            "required"=>"من فضلك هذة البيانات مطلوبة",
            "string"=>"هذة البيانات لابد ان تكون ب الاحرف",
            "unique"=>"هذا الحقل لا يمكن ان يتكرر"
        ];
    }
}
