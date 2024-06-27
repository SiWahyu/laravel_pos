<?php

namespace App\Services;

use App\Models\Produk;

interface ProdukService
{

    function getAll();

    function create(array $data);

    function update(Produk $produk, array $data);

    function delete(Produk $produk);
}