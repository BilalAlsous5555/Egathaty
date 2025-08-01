<?php

namespace App\Http\Requests\AuthRequest;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'name'=>'string|required|max:100|min:3',
        'email'=>'required|email|string|unique:users,email,',
        'password'=>'string|required|min:8',
        ];
    }


    public function messages()
    {
        return 
            [
            'name.string' => 'name should be string !',
            'email.unique' => 'email should be unique !',
            'password.min' => 'password length should be at least 8 charactes !'
            ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            [
            'success' =>false ,
            'message' => 'validation_error',
            'errors' => $validator->errors(),
        ], 422));
    }
}
