<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherRequest extends FormRequest
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
            "teacher_name" => "required",
            "teacher_address" => "required",
            "teacher_birthdate" => "required|date",
            "teacher_hire_date" => "required|date",
            "teacher_salary" => "required|numeric",
            "teacher_genre" => "required",
            "teacher_photo" => "nullable|image",
            "teacher_phone" => "required|unique:teachers,teacher_phone," . $this->teacher->id,
            'teacher_national_number' => "required|numeric|unique:teachers,teacher_national_number," . $this->teacher->id . "|digits:12"
        ];
    }

    public function messages()
    {
        return [
            'teacher_name.required' => '!الرجاء ادخال اسم المعلم',
            'teacher_address.required' => '!الرجاء ادخال  عنوان المعلم',
            'teacher_birthdate.required' => '!الرجاء ادخال تاريخ ميلاد المعلم',
            'teacher_hire_date.required' => '!الرجاء ادخال تاريخ توظيف المعلم',
            'teacher_salary.required' => '!الرجاء ادخال راتب المعلم',
            'teacher_genre.required' => '!الرجاء ادخال جنس المعلم',
            'teacher_photo.image' => '! صورة المعلم غير صالحة',
            'teacher_phone.required' => '! الرجاء ادخال رقم الهاتف',
            'teacher_phone.unique' => '! رقم الهاتف مكرر',
            'national_number.required' => 'الرجاء ادخال الرقم الوطني',
            'national_number.numeric' => ' الرقم الوطني غير صالح',
            'national_number.unique' => ' الرقم الوطني مكرر',
            'national_number.digits' => ' الرقم الوطني غير صالح',
        ];
    }
}
