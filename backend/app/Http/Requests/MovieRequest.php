<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
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
            'description' => 'required|string',
            'date' => 'required|date',
            'director_id' => 'required',
            'category_id' => 'required',
            'trailer' => 'required',
            'time' => 'required',
            'language' => 'required|string',
            'image' => 'file|mimes:jpg,jpeg,png|max:2048',
            'price' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'file' => 'Phải là dạng Files',
            'required' => 'Bắt buộc phải nhập',
            'string' => 'Phải dạng chuỗi A-Z,0-9',
            'min' => 'Phải lớn hơn :min ký tự',
            'max' => 'Phải nhỏ hơn :max ký tự',
        ];
    }
}
