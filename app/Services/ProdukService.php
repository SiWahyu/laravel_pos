<?php

namespace App\Services;

use App\Models\Produk;

interface ProdukService
{

    function getFiltered(array $filter);

    function getAll();

    function create(array $data);

    function update(Produk $produk, array $data);

    function delete(Produk $produk);

    function count(): int;
}