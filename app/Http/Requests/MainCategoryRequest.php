<?php

namespace App\Http\Requests;

use App\Http\Enumerations\CategoryType;
use Illuminate\Foundation\Http\FormRequest;

class MainCategoryRequest extends FormRequest
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
            "photo"=>"mimes:png,jpg,jpeg",
            "name"=>"required|string",
            "slug"=>'required|unique:categories,slug,'.$this->id,
            "type"=>'required|in:1,2'
        ];
    }
    public function messages()
    {
        return [
            "required"=>"من فضلك هذة البيانات مطلوبة",
            "string"=>"هذة البيانات لابد ان تكون ب الاحرف",
            "mimes"=>"الصورة لابد ان تكون من النوع png او jpg او jpeg",
            "unique"=>"هذا الحقل لا يمكن ان يتكرر"
        ];
    }
}
