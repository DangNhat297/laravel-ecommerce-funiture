<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeUpdateRequest extends FormRequest
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
            "name"  => "required|unique:attributes,name,{$this->attr->id}"
        ];
    }

    public function messages()
    {
        return [
            "required"  => ":attribute không được để trống",
            "unique"    => "Tên thuộc tính đã tồn tại"
        ];
    }

    public function attributes()
    {
        return [
            "name"      => "Tên thuộc tính"
        ];
    }
}
