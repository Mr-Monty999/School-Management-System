<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use PhpParser\Node\Expr\FuncCall;

class StoreSubjectRequest extends FormRequest
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
            'subject_name' => 'required',
            'class_id' => 'required',
            'teachers' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'subject_name.required' => 'الرجاء ادخال اسم المادة',
            'class_id.required' => 'الرجاء ادخال اسم الفصل',
        ];
    }
}
