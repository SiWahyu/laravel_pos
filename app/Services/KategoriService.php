<?php

namespace App\Services;


use App\Models\Kategori;

interface KategoriService
{

    function getAll();

    function findById(int $id): Kategori;

    function update(Kategori $kategori, array $data);

    function create(array $data);

    function delete(Kategori $kategori);
}
