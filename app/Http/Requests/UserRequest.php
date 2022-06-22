<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $validation = [
            'password' => 'required'
        ];
        switch ($this->route()->getName())
        {
            case "user_login":
                $validation['email'] = 'required|max:255';
                break;
            case "user_register":
                $validation['name']  = 'required|unique:users';
                $validation['email'] = 'required|unique:users';
                $validation['password_repeat'] = 'required';
                break;
            case "register":
                $validation['name']  = 'required|unique:users';
                $validation['email'] = 'required|unique:users';
                $validation['password_repeat'] = 'required';
                break;
            case "login":
            $validation['email'] = 'required';
        }
        return $validation;
    }
}
