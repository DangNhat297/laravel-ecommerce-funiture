<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email'     => 'required|email|exists:users,email',
            'password'  => 'required|min:6'
        ];
    }

    public function messages()
    {
        return [
            'email'     => 'Sai định dạng email',
            'required'  => ':attribute không được để trống',
            'min'       => ':attribute tối thiểu :min kí tự',
            'exists'    => 'Tài khoản không tồn tại trên hệ thống'
        ];
    }

    public function attributes()
    {
        return [
            'email'     => 'Email',
            'password'  => 'Mật khẩu'
        ];
    }
}
