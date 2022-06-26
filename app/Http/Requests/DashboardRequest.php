<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DashboardRequest extends FormRequest
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
            "admin_name" => "required",
            "password" => "required"
        ];
    }

    public function messages()
    {
        return [
            "admin_name.required" => "الرجاء ادخال اسم المدير !",
            "password.required" => "الرجاء ادخال كلمة المرور !"
        ];
    }
}
