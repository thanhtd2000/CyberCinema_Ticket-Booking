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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'price' => 'required',
            'count' => 'required',
            'image' => 'file|mimes:jpg,jpeg,png|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Bắt buộc phải nhập',
            'file' => 'Phải là dạng Files',
        ];
    }
}
