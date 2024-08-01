<?php

namespace App\Services\Impl;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
use App\Services\OrderItemService;

class OrderItemServiceImpl implements OrderItemService
{


    function create(Order $order, Cart $cart)
    {
        foreach ($cart->cart_items as $item) {

            OrderItem::create([
                'order_id' => $order->id,
                'produk_id' => $item->produk->id,
                'jumlah' => $item->jumlah,
            ]);
        }
    }
}
