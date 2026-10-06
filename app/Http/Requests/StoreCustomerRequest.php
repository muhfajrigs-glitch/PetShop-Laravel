<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            // name wajib diisi
            'name' => 'required|string|max:150',
            
            // phone boleh kosong, tapi kalau diisi harus max 30 karakter
            'phone' => 'nullable|string|max:30',
            
            // email boleh kosong, tapi kalau diisi harus email format dan unique
            'email' => 'nullable|email|unique:customers,email',
            
            // address boleh kosong
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