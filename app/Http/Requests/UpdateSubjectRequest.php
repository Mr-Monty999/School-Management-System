<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSubjectRequest extends FormRequest
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
            'subject_name' => 'required|unique:subjects,subject_name,' . $this->subject->id,
            'class_id' => 'required',
            'teachers' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'subject_name.required' => 'الرجاء ادخال اسم المادة !',
            'class_id.required' => 'الرجاء ادخال اسم الفصل !',
            'subject_name.unique' => 'هذه المادة موجودة بالفعل !'
        ];
    }
}
