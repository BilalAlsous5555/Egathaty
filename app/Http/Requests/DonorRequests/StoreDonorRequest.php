<?php

namespace App\Http\Requests\DonorRequests; 

use Illuminate\Foundation\Http\FormRequest;

class StoreDonorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * This method defines whether the current authenticated user has permission
     * to perform the action associated with this request (e.g., create or update a donor).
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * These rules ensure that the incoming data meets the required format and constraints.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:individual,organization'],
            'contact_info' => ['required', 'string'],
        ];
    }

    /**
     * Get the custom validation messages for the defined validation rules.
     * This allows you to provide more user-friendly and specific error messages
     * when validation fails.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The donor name is required.',
            'name.string' => 'The donor name must be a string.',
            'name.max' => 'The donor name cannot exceed 255 characters.',
            'type.required' => 'The donor type is required.',
            'type.in' => 'The donor type must be either "individual" or "organization".',
            'contact_info.required' => 'Contact information is required.',
            'contact_info.string' => 'Contact information must be a string.',
        ];
    }
}
