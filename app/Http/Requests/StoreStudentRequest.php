<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            "student_name" => "required",
            "student_address" => "required",
            "student_birthdate" => "required|date",
            "student_registered_date" => "required|date",
            "student_paid_price" => "required|numeric",
            "student_gender" => "required",
            "student_photo" => "nullable|image",
            "parent_name" => "required",
            'parent_job' => 'required',
            'parent_phone' => 'required',
            'class_id' => 'required',
            'student_national_number' => 'required|unique:students|digits:12',
            'parent_national_number' => 'required|digits:12',
        ];
    }

    public function messages()
    {
        return [
            "student_name.required" => "الرجاء ادخال اسم الطالب !",
            "student_address.required" => "الرجاء ادخال عنوان الطالب !",
            "student_birthdate.required" => "الرجاء ادخال تاريخ ميلاد الطالب !",
            "student_registered_date.required" => "الرجاء ادخال تاريخ تسجيل الطالب !",
            "student_paid_price.required" => " الرجاء ادخال رسوم الطالب ! المدفوعة",
            "student_gender.required" => "الرجاء ادخال جنس الطالب !",
            "student_photo.image" => "صورة الطالب ! غير صالحة",
            "student_class.required" => "الرجاء ادخال فصل الطالب !",
            "parent_name.required" => "الرجاء ادخال اسم ولي أمر الطالب !",
            "parent_phone.required" => "الرجاء ادخال رقم ولي أمر الطالب !",
            "parent_job.required" => "الرجاء ادخال مهنة ولي أمر الطالب !",
            "student_paid_price.numeric" => "الرجاء ادخال ارقام فقط",
            "student_national_number.required" => "الرجاء ادخال رقم الطالب الوطني",
            "student_national_number.digits" => " الرقم الوطني غير صالح",
            "student_national_number.unique" => " الرقم الوطني مكرر",
            "parent_national_number.required" => "الرجاء ادخال رقم ولي الامر الوطني",
            "parent_national_number.digits" => "الرقم الوطني غير صالح",
        ];
    }
}
