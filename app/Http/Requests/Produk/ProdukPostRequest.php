<?php

namespace App\Http\Requests\Produk;

use Illuminate\Foundation\Http\FormRequest;

class ProdukPostRequest extends FormRequest
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
            'kode' => ['required', 'unique:produks,kode', 'min:10'],
            'nama' => ['required'],
            'kategori_id' => ['required', 'not_in:---PILIH---'],
            'harga' => ['required', 'numeric', 'min:1'],
            'stok' => ['required', 'numeric', 'min:0'],
            'gambar' => ['required', 'max:1000', 'mimes:png,jpg,jpeg']
        ];
    }
}