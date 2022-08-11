<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'images.0'              => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'images.*'              => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'price'                 => 'required|numeric',
            'promotion'             => 'nullable|numeric|lt:price',
            'name'                  => 'required|min:5|max:70',
            'slug'                  => 'required',
            'quantity'              => 'required|min:0|numeric',
            'categories'            => 'required|array|min:1',
            'attributeValues.*.*'   => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required'      => ':attribute không được để trống',
            'image'         => 'Sai định dạng hình ảnh',  
            'lt'            => 'Giá khuyến mãi phải nhỏ hơn giá gốc',
            'images.*.max'  => 'Tệp hình ảnh không được vượt quá 5 mb',
            'min'           => ':attribute nhập tối thiểu :min kí tự',
            'max'           => ':attribute nhập tối đa :max kí tự',
            'numeric'       => 'Vui lòng nhập số'
        ];
    }

    public function attributes()
    {
        return [
            'images.0'              => 'Ảnh đại diện',
            'price'                 => 'Giá sản phẩm',
            'promotion'             => 'Giá khuyến mãi',
            'name'                  => 'Tên sản phẩm',
            'slug'                  => 'Đường dẫn',
            'quantity'              => 'Số lượng hàng trong kho',
            'categories'            => 'Danh mục sản phẩm',
            'attributeValues.*.*'   => 'Tên biến thể',
        ];
    }
}
