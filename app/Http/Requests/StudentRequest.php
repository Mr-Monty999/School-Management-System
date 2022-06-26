<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            "student_genre" => "required",
            "student_photo" => "image",
            "student_class" => "required",
            "parent_name" => "required"
        ];
    }
}
