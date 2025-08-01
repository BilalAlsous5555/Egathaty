<?php

namespace App\Http\Requests\DonationRequests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDonation extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'donor_id'        => ['sometimes', 'exists:donors,id'],
            'type'            => ['sometimes', Rule::in(['cash', 'in_kind'])],
            'date_received'   => ['sometimes', 'date'],

            'cash.amount'     => ['required_if:type,cash', 'numeric', 'min:0.01'],
            'cash.currency'   => ['required_if:type,cash', 'string', 'max:10'],

            'in_kind.item_name'    => ['required_if:type,in_kind', 'string'],
            'in_kind.quantity'     => ['required_if:type,in_kind', 'integer', 'min:1'],
            'in_kind.expiry_date' => ['nullable', 'date', 'after:today'],
            'in_kind.description' => ['nullable', 'string',  'max:255'],

            'attachments'          => ['array', 'nullable'],
            'attachments.*'        => ['file', 'mimes:jpg,jpeg,png,pdf'],
        ];
    }
}
