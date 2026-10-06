<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            // customer_id harus ada di tabel customers
            'customer_id' => 'required|exists:customers,id',
            
            'name' => 'required|string|max:100',
            
            // species wajib diisi (jenis hewan: dog, cat, etc)
            'species' => 'required|string|max:50',
            
            // breed opsional (jenis ras)
            'breed' => 'nullable|string|max:100',
            
            // gender harus salah satu: male, female, atau unknown
            'gender' => 'nullable|in:male,female,unknown',
            
            // birth_date harus date format dan tidak boleh hari ini atau masa depan
            'birth_date' => 'nullable|date|before:today',
            
            // notes opsional
            'notes' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'customer_id.required' => 'Please select a customer.',
            'customer_id.exists' => 'The selected customer is invalid.',
            'name.required' => 'Pet name is required.',
            'name.string' => 'Pet name must be text.',
            'name.max' => 'Pet name must not exceed 100 characters.',
            'species.required' => 'Pet species is required.',
            'species.string' => 'Pet species must be text.',
            'species.max' => 'Pet species must not exceed 50 characters.',
            'breed.string' => 'Breed must be text.',
            'breed.max' => 'Breed must not exceed 100 characters.',
            'gender.in' => 'Gender must be male, female, or unknown.',
            'birth_date.date' => 'Birth date must be a valid date.',
            'birth_date.before' => 'Birth date cannot be in the future.',
            'notes.string' => 'Notes must be text.',
        ];
    }
}