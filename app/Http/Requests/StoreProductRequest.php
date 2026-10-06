<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            // category_id harus:
            // - required (wajib pilih kategori)
            // - exists (ID kategori harus ada di tabel 'categories' kolom 'id')
            'category_id' => 'required|exists:categories,id',
            
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            
            // price harus:
            // - required
            // - numeric (angka, bisa desimal)
            // - min:0 (tidak boleh negatif)
            'price' => 'required|numeric|min:0',
            
            // stock harus:
            // - required
            // - integer (angka bulat, bukan desimal)
            // - min:0
            'stock' => 'required|integer|min:0',
            
            // status harus:
            // - required
            // - in (hanya boleh nilai 'active' atau 'inactive')
            'status' => 'required|in:active,inactive',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'The selected category is invalid.',
            'name.required' => 'Product name is required.',
            'name.string' => 'Product name must be text.',
            'name.max' => 'Product name must not exceed 150 characters.',
            'description.string' => 'Description must be text.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a number.',
            'price.min' => 'Price cannot be negative.',
            'stock.required' => 'Stock is required.',
            'stock.integer' => 'Stock must be a whole number.',
            'stock.min' => 'Stock cannot be negative.',
            'status.required' => 'Status is required.',
            'status.in' => 'Status must be either active or inactive.',
        ];
    }
}