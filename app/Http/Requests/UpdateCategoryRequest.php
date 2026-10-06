<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            // PENTING: Rule::unique buat allow current value
            // Artinya: cek unique EXCEPT untuk ID category yang sedang diedit
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('categories', 'name')->ignore($this->category->id),
            ],
            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Category name is required.',
            'name.string' => 'Category name must be text.',
            'name.max' => 'Category name must not exceed 100 characters.',
            'name.unique' => 'This category name already exists.',
            'description.string' => 'Description must be text.',
        ];
    }
}