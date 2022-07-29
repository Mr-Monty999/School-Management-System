<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateParentRequest extends FormRequest
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
            "parent_name" => "required",
            "parent_job" => "required",
            "parent_phone" => "required",
            "parent_national_number" => "required|digits:12|unique:parents,parent_national_number," . $this->parent->id . ""
        ];
    }

    public function messages()
    {
        return [
            "parent_name.required" => "الرجاء إدخال اسم ولي الأمر !",
            "parent_job.required" => "الرجاء إدخال الوظيفة !",
            "parent_phone.required" => "الرجاء إدخال رقم الهاتف !",
            "parent_national_number.required" => "الرجاء إدخال الرقم الوطني !",
            "parent_national_number.unique" => "الرقم الوطني مكرر !",
            "parent_national_number.digits" => "الرقم الوطني غير صالح !"
        ];
    }
}
