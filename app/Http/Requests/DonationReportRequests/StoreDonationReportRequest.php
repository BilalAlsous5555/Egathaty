<?php

namespace App\Http\Requests\DonationReportRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreDonationReportRequest extends FormRequest
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


        $rules = [
            'donor_id' => ['required', 'exists:donors,id'],
            'report_period_start' => ['required', 'date'],
            'report_period_end' => ['required', 'date', 'after_or_equal:report_period_start'],
            'report_file' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            'generated_by_user_id' => ['nullable', 'exists:users,id'],
        ];

        return $rules;
    }

    /**
     * Handle a failed validation attempt.
     * This method is automatically called by Laravel when validation fails.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {



        throw new HttpResponseException(response()->json([
            'message' => 'Validation Error',
            'errors' => $validator->errors()
        ], 422));
    }
}
