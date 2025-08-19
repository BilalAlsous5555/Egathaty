<?php

namespace App\Http\Requests\InventoryItemRequests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventoryItemRequest extends FormRequest
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
            'warehouse_id' => ['required', 'exists:warehouses,id'],
            'in_kind_donation_id' => ['nullable', 'exists:in_kind_donations,id'], 
            'item_name' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'expiry_date' => ['nullable', 'date', 'after_or_equal:today'],
            'threshold_quantity' => ['nullable', 'integer', 'min:0'],
        ];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'warehouse_id.required' => 'The warehouse ID is required.',
            'warehouse_id.exists' => 'The selected warehouse does not exist.',
            'in_kind_donation_id.exists' => 'The selected in-kind donation does not exist.',
            'item_name.required' => 'The item name is required.',
            'quantity.required' => 'The quantity is required.',
            'quantity.integer' => 'The quantity must be an integer.',
            'quantity.min' => 'The quantity cannot be less than 0.',
            'expiry_date.after_or_equal' => 'The expiry date must be today or a future date.',
            'threshold_quantity.min' => 'Threshold quantity cannot be less than 0.',
        ];
    }
}
