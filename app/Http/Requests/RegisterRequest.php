<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
{
    /**
     * @var mixed
     */
    /**
     * @var mixed
     */
    private $firstname;
    /**
     * @var mixed
     */
    private $lastname;
    /**
     * @var mixed
     */
    private $email;
    /**
     * @var mixed
     */
    private $password;


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'username' => 'required|string|unique:users',
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ];
    }
    public function messages(): array
    {
        return [
            'firstname.required' => 'Firstname is required',
            'lastname.required' => 'Lastname is required',
            'email.required' => 'Email is required',
            'username.required' => 'Username is required',
            'password.required' => 'Password is required',
            'password_confirmation.required' => 'Password Confirmation is required',
            'email.email' => 'Email is not correct'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
