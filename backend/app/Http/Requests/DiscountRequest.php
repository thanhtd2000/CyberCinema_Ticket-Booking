<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
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
            'code' => 'required',
            'count' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'percent' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => "Bắt buộc phải nhập",
        ];
    }
}
