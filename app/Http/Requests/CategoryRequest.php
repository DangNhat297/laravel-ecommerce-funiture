<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name'      => 'required|unique:categories,name',
            'slug'      => 'required|unique:categories,slug',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif'
        ];
    }

    public function messages()
    {
        return [
            'required'  => ':attribute không được để trống',
            'image'     => 'Sai định dạng hình ảnh',
            'unique'    => ':attribute đã tồn tại trên hệ thống'
        ];
    }

    public function attributes()
    {
        return [
            'name'      => 'Tên danh mục',
            'slug'      => 'Đường dẫn danh mục'
        ];
    }
}
