<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKategoriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('kategori');
        return [
            'nama_kategori' => [
                'required', 'string', 'max:100',
                Rule::unique('kategori', 'nama_kategori')->ignore($id, 'id_kategori'),
            ],
            'slug' => [
                'nullable', 'string', 'max:150',
                Rule::unique('kategori', 'slug')->ignore($id, 'id_kategori'),
            ],
            'warna_badge' => ['nullable', 'string', 'max:20'],
            'icon' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah digunakan.',
        ];
    }
}
