<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDestinasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('destinasi');
        return [
            'nama' => [
                'required', 'string', 'max:200',
                Rule::unique('destinasi', 'nama')->ignore($id, 'id_destinasi'),
            ],
            'id_kategori' => ['required', 'integer', 'exists:kategori,id_kategori'],
            'lokasi' => ['required', 'string', 'max:255'],
            'ketinggian_mdpl' => ['nullable', 'integer', 'min:0'],
            'jarak_km' => ['nullable', 'numeric', 'min:0'],
            'harga_tiket' => ['nullable', 'numeric', 'min:0'],
            'jam_buka' => ['nullable', 'date_format:H:i'],
            'jam_tutup' => ['nullable', 'date_format:H:i'],
            'buka_24jam' => ['nullable', 'boolean'],
            'deskripsi' => ['nullable', 'string'],
            'foto_utama' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'fasilitas' => ['nullable', 'string', 'max:500'],
            'status_aktif' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama destinasi wajib diisi.',
            'nama.unique' => 'Nama destinasi sudah digunakan.',
            'id_kategori.required' => 'Kategori wajib dipilih.',
            'id_kategori.exists' => 'Kategori tidak valid.',
            'lokasi.required' => 'Lokasi wajib diisi.',
            'foto_utama.image' => 'File harus berupa gambar.',
            'foto_utama.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'foto_utama.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
