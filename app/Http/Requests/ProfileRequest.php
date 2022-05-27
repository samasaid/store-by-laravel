<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            "name"=>"required",
            "email"=>'required|email|unique:admins,email,'.$this->id,
            "password"=>"nullable|confirmed"
        ];
    }
    public function messages()
    {
        return [
            "required"=>'من فضلك ادخل البيانات هذا الحقل مطلوب',
            "email.email"=>'صيغة البريد الالكترونى غير صحيحة',
            "email.unique"=>'هذا البريد الالكترونى مستخدم من قبل',
            "password.confirmed"=>'يجب تأكيد كلمة المرور',
        ];
    }
}
