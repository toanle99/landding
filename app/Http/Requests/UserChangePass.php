<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserChangePass extends FormRequest
{

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
            'current_password' => 'required',
            'password' => 'required|min:4|alpha_num|confirmed',
        ];
    }

    public function attributes()
    {
        return  [
            'password' => 'Mật khẩu',
            'current_password' => 'Mật khẩu cũ', 
        ];
    }
}
