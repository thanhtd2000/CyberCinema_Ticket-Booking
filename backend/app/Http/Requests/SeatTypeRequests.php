<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeatTypeRequests extends FormRequest
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
            'name' => 'required|unique:seat_types,name',
            'price' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'This field cannot be empty!',
            'unique' => 'This field already exists!'
        ];
    }
}
