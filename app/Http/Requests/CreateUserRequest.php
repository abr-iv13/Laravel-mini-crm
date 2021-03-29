<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'email' => 'required|email|unique:App\Models\User,email',
            'password' => 'required|min:5',
            'role' => 'required', 
            'gender_id'  => 'required', 
            'position_id' => 'required', 
            'status_id'  => 'required', 
            'section_id' => 'required',
        ];
    }
}
