<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;

interface OrderItemService
{

    function create(Order $oder, Cart $cart);
}
