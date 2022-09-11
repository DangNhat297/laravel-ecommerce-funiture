<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name'      => 'required',
            'email'     => 'required|email',
            'subject'   => 'required',
            'message'   => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required'  => ':attribute không được để trống',
            'email'     => 'Sai định dạng email'
        ];
    }

    public function attributes()
    {
        return [
            'name'      => 'Họ và tên',
            'email'     => 'Email',
            'subject'   => 'Tiêu đề',
            'message'   => 'Nội dung'
        ];
    }
}
