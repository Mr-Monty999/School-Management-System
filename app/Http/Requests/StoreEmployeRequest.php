<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeRequest extends FormRequest
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
            "employe_name" => "required",
            "employe_address" => "required",
            "employe_birthdate" => "required|date",
            "employe_hire_date" => "required|date",
            "employe_salary" => "required|numeric",
            "employe_gender" => "required",
            "employe_photo" => "nullable|image",
            "employe_phone" => "required",
            "employe_job" => "required",
            'employe_national_number' => 'required|numeric|unique:employees,employe_national_number|digits:12'
        ];
    }

    public function messages()
    {
        return [
            'employe_name.required' => '!الرجاء ادخال اسم الموظف',
            'employe_address.required' => '!الرجاء ادخال  عنوان الموظف',
            'employe_birthdate.required' => '!الرجاء ادخال تاريخ ميلاد الموظف',
            'employe_hire_date.required' => '!الرجاء ادخال تاريخ توظيف الموظف',
            'employe_salary.required' => '!الرجاء ادخال راتب الموظف',
            'employe_gender.required' => '!الرجاء ادخال جنس الموظف',
            'employe_photo.image' => '! صورة الموظف غير صالحة',
            'employe_phone.required' => '! الرجاء ادخال رقم الهاتف',
            'employe_phone.unique' => '! رقم الهاتف مستخدم بالفعل',
            'employe_national_number.required' => 'الرجاء ادخال الرقم الوطني',
            'employe_national_number.numeric' => ' الرقم الوطني غير صالح',
            'employe_national_number.unique' => ' الرقم الوطني مستخدم بالفعل',
            'employe_national_number.digits' => ' الرقم الوطني غير صالح',
            "employe_job.required" => "الرجاء إدخال الوظيفة !",

        ];
    }
}
