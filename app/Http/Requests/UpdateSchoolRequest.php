<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSchoolRequest extends FormRequest
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
            "school_name" => "required",
            "school_owner" => "required",
            "school_address" => "required",
            "school_phone" => "required",
            "school_year_price" => "required|numeric",
            "school_logo" => "nullable"
        ];
    }

    public function messages()
    {
        return [
            "school_name.required" => "الرجاء كتابة أسم المدرسة !",
            "school_owner.required" => "الرجاء كتابة اسم المالك !",
            "school_address.required" => "الرجاء كتابة عنوان المدرسة !",
            "school_phone.required" => "الرجاء كتابة رقم الهاتف !",
            "school_year_price.required" => "الرجاء كتابة سعر السنة الدراسية !",
            "school_year_price.numeric" => "الرجاء كتابة ارقام فقط !",


        ];
    }
}
