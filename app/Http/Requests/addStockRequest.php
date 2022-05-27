<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addStockRequest extends FormRequest
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
            "sku"=>"required|min:2|max:8",
            "product_id"=>"required|exists:products,id",
            "manage_stock"=>"required|in:0,1",
            "in_stock"=>"required|in:0,1",
            "qty"=>"required_if:manage_stock,1"
            // "qty"=>[ new PreoductQty($manage_stock)]
        ];
    }
}
