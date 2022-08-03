<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClassRequest extends FormRequest
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
            "class_name" => "required|unique:classes,class_name," . $this->class->id
        ];
    }

    public function messages()
    {
        return [
            "class_name.required" => "الرجاء كتابة اسم الفصل !",
            "class_name.unique" => "هذا الفصل موجود بالفعل !"
        ];
    }
}
