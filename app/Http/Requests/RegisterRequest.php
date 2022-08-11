<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'fullname'  => 'required',
            'username'  => 'required|unique:users,username',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6'
        ];
    }

    public function messages()
    {
        return [
            'required'  => ':attribute không được để trống',
            'unique'    => ':attribute đã tồn tại',
            'email'     => 'Sai định dạng email',
            'min'       => ':attribute tối thiểu :min kí tự'
        ];
    }

    public function attributes()
    {
        return [
            'fullname'  => 'Họ và tên',
            'username'  => 'Tên đăng nhập',
            'email'     => 'Email',
            'password'  => 'Mật khẩu'
        ];
    }
}
