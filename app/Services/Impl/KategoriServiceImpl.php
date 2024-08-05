<?php

namespace App\Services\Impl;

use App\Models\Kategori;
use App\Services\KategoriService;


class KategoriServiceImpl implements KategoriService
{

    function getAll()
    {
        return Kategori::all();
    }

    function findById(int $id): Kategori
    {
        return Kategori::find($id)->first();
    }

    function update(Kategori $kategori, array $data)
    {

        try {
            $update = $kategori->update([
                'nama' => $data['nama']
            ]);

            return $update;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function create(array $data)
    {
        try {
            $create = Kategori::create([
                'nama' => $data['nama']
            ]);

            return $create;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function delete(Kategori $kategori)
    {
        try {

            return $kategori->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function count(): int
    {

        $total = Kategori::count('id');

        return $total;
    }
}