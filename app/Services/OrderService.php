<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;

interface OrderService
{

    function getAll();

    function getUserOrder();

    function create(Cart $cart, string $pembayaran);

    function findByKode(string $kode);

    function updateStatus(Order $order, string $status);

    function checkout(Order $order);
}