<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nama',
            'email' => 'Email',
            'password' => 'Kata Sandi',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute harus diisi',
            'string' => ':attribute harus berupa string',
            'min' => ':attribute harus lebih dari :min karakter',
            'max' => ':attribute tidak boleh lebih dari :max karakter',
            'unique' => ':attribute sudah digunakan',
            'email' => ':attribute harus berupa email',
        ];
    }
}
