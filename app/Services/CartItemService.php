<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Produk;

interface CartItemService
{

    function findByProdukId(Produk $produk);

    function create(Cart $cart, Produk $produk, array $data);
}
