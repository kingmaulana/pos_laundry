<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'paket_id' => 'required|exists:pakets,id',
            'status' => 'required|string|max:255',
            'tgl' => 'required|date',
            'berat' => 'required|numeric|min:0',
            'total_harga' => 'required|numeric|min:0',
        ];
    }

    public function attributes()
    {
        return [
            'user_id' => 'ID User',
            'paket_id' => 'ID Paket',
            'status' => 'Status Order',
            'tgl' => 'Tanggal Order',
            'berat' => 'Berat Laundry',
            'total_harga' => 'Total Harga Laundry'
        ];
    }
}
