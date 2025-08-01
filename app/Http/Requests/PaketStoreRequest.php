<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaketStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
            'tgl' => 'required|date',
            'harga' => 'required|numeric'
        ];
    }

    public function attributes()
    {
        return [
            'nama' => 'Nama Paket',
            'deskripsi' => 'Deskripsi Paket',
            'tgl' => 'Tanggal',
            'harga' => 'Harga Paket'
        ];
    }
}
