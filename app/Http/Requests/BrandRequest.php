<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            "photo"=>"mimes:png,jpg,jpeg"
        ];
    }
    public function messages()
    {
        return [
            "required"=>"من فضلك هذة البيانات مطلوبة",
            "string"=>"هذة البيانات لابد ان تكون بالاحرف",
            "mimes"=>"امتداد الصورة يجب ان يكون png او jpg او jpeg"
        ];
    }
}
