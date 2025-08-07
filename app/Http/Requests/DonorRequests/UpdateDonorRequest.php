<?php

namespace App\Http\Requests\DonorRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; 

class UpdateDonorRequest extends FormRequest
{
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
