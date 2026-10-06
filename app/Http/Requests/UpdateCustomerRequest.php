<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:150',
            'phone' => 'nullable|string|max:30',
            
            // Email unique EXCEPT current email
            'email' => [
                'nullable',
                'email',
                Rule::unique('customers', 'email')->ignore($this->customer->id),
            ],
            
            'address' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Customer name is required.',
            'name.string' => 'Customer name must be text.',
            'name.max' => 'Customer name must not exceed 150 characters.',
            'phone.string' => 'Phone must be text.',
            'phone.max' => 'Phone must not exceed 30 characters.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already registered.',
            'address.string' => 'Address must be text.',
        ];
    }
}