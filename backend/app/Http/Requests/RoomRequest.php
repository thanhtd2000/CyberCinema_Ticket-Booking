<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'name' => 'required|unique:rooms,name',
            'row' => 'required',
            'column' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'required' => 'This field cannot be empty!',
            'unique' => 'This field already exists!',
          
        ];
    }
}
