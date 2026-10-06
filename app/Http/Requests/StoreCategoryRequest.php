<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    // Step 1: Siapa yang boleh submit form ini?
    // Jawab: Siapa saja yang sudah login (semua user)
    public function authorize(): bool
    {
        return auth()->check(); // true jika user sudah login
    }

    // Step 2: Validasi rules — apa aja yang harus dicek?
    public function rules(): array
    {
        return [
            // name harus:
            // - required (wajib diisi)
            // - string (teks, bukan angka)
            // - max 100 karakter
            // - unique di tabel 'categories' di kolom 'name'
            'name' => 'required|string|max:100|unique:categories,name',
            
            // description boleh kosong (nullable)
            // tapi kalau diisi harus string
            'description' => 'nullable|string',
        ];
    }

    // Step 3: Pesan error yang lebih user-friendly
    // Kalau validation gagal, tampilkan pesan ini
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