<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'name'      => 'nullable',
            'email'     => 'nullable|email',
            'message'   => 'required|min:5'
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
            'message'   => 'Nội dung đánh giá'
        ];
    }
}
