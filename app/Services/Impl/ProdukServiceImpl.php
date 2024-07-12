<?php

namespace App\Services\Impl;

use App\Models\Produk;
use App\Services\ProdukService;
use Illuminate\Support\Facades\Storage;

class ProdukServiceImpl implements ProdukService
{

    function getFiltered(array $filter)
    {
        $query = Produk::query();

        if (!empty($filter['kategori'])) {
            $query->whereHas('kategori', function ($query) use ($filter) {
                $query->where('nama', $filter['kategori']);
            });
        }
        if (!empty($filter['nama'])) {
            $query->where('nama', 'like', $filter['nama'] . "%");
        }

        return $query->with('kategori')->get();
    }

    function getAll()
    {
        // data produk beserta kategori nya
        return $dataProduk = Produk::with('kategori')->get();
    }

    function create(array $data)
    {

        try {

            $gambar = $data['gambar'];

            // mengupload gambar
            $uploadGambar = Storage::putFileAs('public/images/produk/', $gambar, $gambar->hashName());

            // membuat data produk jika gambar berhasil di upload
            if ($uploadGambar) {
                $produk = Produk::create([
                    'kode' => $data['kode'],
                    'nama' => $data['nama'],
                    'kategori_id' => $data['kategori_id'],
                    'harga' => $data['harga'],
                    'stok' => $data['stok'],
                    'gambar' => $gambar->hashName(),
                ]);

                return $produk;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function delete(Produk $produk)
    {
        try {

            // delete gambar produk
            $deleteGambar = Storage::delete('public/images/produk/' . $produk->gambar);

            // delete produk
            return $produk->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function update(Produk $produk, array $data)
    {
        try {

            // mengecek apa ada gambar yang di upload
            if (isset($data['gambar'])) {

                $gambar = $data['gambar'];

                // menghapus gambar lama
                $deleteGambar = Storage::delete('public/images/produk/' . $produk->gambar);

                // mengupload gambar baru
                $uploadGambar = Storage::putFileAs('public/images/produk/', $gambar, $gambar->hashName());

                if ($deleteGambar && $uploadGambar) {

                    $produk->gambar = $gambar->hashName();
                }
            }

            $produk->kode = $data['kode'];
            $produk->nama = $data['nama'];
            $produk->kategori_id = $data['kategori_id'];
            $produk->harga = $data['harga'];
            $produk->stok = $data['stok'];

            $update = $produk->save();

            return $update;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
