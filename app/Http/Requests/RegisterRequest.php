<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string',
            'username' => 'required|string|unique:users',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
            'phone' => 'required|string',
        ];
    }

    public function messages() {
        return [
            'name.required' => ':attribute  is required',
            'username.required' => ':attribute  is required.',
            'username.unique' => 'user with that username already exists',
            'email.required' => ':attribute  is required.',
            'email.email' => ':attribute must be a valid email.',
            'email.unique' => 'user with that email already exists',
            'password.required' => ':attribute is required.',
            'password.confirmed' => ':attribute does not match.',
            'phone.required' => ':attribute  is required',
            ];
    }
}
