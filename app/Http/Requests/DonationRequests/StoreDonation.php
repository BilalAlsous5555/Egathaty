<?php

namespace App\Http\Requests\DonationRequests;

use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDonation extends FormRequest
{
    public function authorize(): bool
    {
        return true; // أو تحقق من صلاحيات المستخدم
    }

    public function rules(): array
    {
        return [
            'donor_id'        => ['required', 'exists:donors,id'],
            'type'            => ['required', Rule::in(['cash', 'in_kind'])],
            'date_received'   => ['required', 'date'],

            // فقط إذا كان نوع التبرع نقدي
            'cash.amount'     => ['required_if:type,cash', 'numeric', 'min:0.01'],
            'cash.currency'   => ['required_if:type,cash', 'string', 'max:10'],

            // فقط إذا كان نوع التبرع عيني
            'in_kind.item_name'    => ['required_if:type,in_kind', 'string'],
            'in_kind.quantity'     => ['required_if:type,in_kind', 'integer', 'min:1'],
            'in_kind.expiry_date' => ['nullable', 'date', 'after:today'],
            'in_kind.description' => ['nullable', 'string',  'max:255'],

            // المرفقات
            'attachments'          => ['array', 'nullable'],
            'attachments.*'        => ['file', 'mimes:jpg,jpeg,png,pdf'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'date_received' => $this->input('date_received') ?? Carbon::now()->toDateString(),
        ]);
    }

    public function messages(): array
    {
        return [
            'cash.amount.required_if' => 'please input numeric value',
            'in_kind.item_name.required_if' => 'input the name of material'
        ];
    }
}
