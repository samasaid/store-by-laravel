<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OptionRequest extends FormRequest
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
            "name"=>"required|unique:option_translations,name,".$this->id,
            "price"=>"required|numeric|min:0",
            "attribute_id"=>"required|exists:attributes,id",
            "product_id"=>"required|exists:products,id"
        ];
    }
}
