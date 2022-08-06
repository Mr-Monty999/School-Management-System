<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePrivacyRequest extends FormRequest
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
            "username" => "unique:users,username," . Auth::id(),
            "password" => "nullable"
        ];
    }

    public function messages()
    {
        return [
            "username.unique" => "هذا الإسم موجود بالفعل"
        ];
    }
}
