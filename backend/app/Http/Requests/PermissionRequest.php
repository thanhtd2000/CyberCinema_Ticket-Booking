<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
            'permission_parent' => 'required|unique:roles,name',
            
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
