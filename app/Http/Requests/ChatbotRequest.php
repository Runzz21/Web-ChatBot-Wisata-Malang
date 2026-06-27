<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChatbotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'step' => ['required', 'integer', 'in:1,2,3'],
            'id_kategori' => ['required_if:step,2', 'nullable', 'integer', 'exists:kategori,id_kategori'],
            'jarak' => ['required_if:step,3', 'nullable', 'string', 'in:<10,10-25,25-50,>50'],
            'anggaran' => ['nullable', 'string', 'in:gratis,<10000,10000-20000,>20000'],
        ];
    }

    public function messages(): array
    {
        return [
            'id_kategori.required_if' => 'Silakan pilih kategori wisata.',
            'jarak.required_if' => 'Silakan pilih jarak tempuh.',
            'jarak.in' => 'Pilihan jarak tidak valid.',
            'anggaran.in' => 'Pilihan anggaran tidak valid.',
        ];
    }
}
