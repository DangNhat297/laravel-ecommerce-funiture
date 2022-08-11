<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'fullname'          => 'required',
            'email'             => 'required|email',
            'phone'             => 'required',
            'address.province'  => 'required',
            'address.district'  => 'required',
            'address.ward'      => 'required',
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
            'fullname'          => 'Họ và tên',
            'email'             => 'Email',
            'phone'             => 'Số điện thoại',
            'address.province'  => 'Tỉnh thành',
            'address.district'  => 'Quận huyện',
            'address.ward'      => 'Xã phường'
        ];
    }
}
