<?php

namespace App\Http\Requests\Karyawan;

use Illuminate\Foundation\Http\FormRequest;

class KaryawanPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => ['required'],
            'posisi' => ['required', 'exists:roles,name', 'not_in:---PILIH---'],
            'email' => ['required', 'unique:users,email', 'email'],
            'telepon' => ['required', 'numeric', 'min_digits:10', 'max_digits:10', 'unique:karyawans,telepon'],
        ];
    }
}
