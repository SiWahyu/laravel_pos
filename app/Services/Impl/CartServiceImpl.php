<?php

namespace App\Services\Impl;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Customer;
use App\Services\CartService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CartServiceImpl implements CartService
{

    function getUserCart()
    {
        $cart = Cart::where('customer_id', Auth::user()->customer->id)->with(['cart_items', 'cart_items.produk'])->first();

        return $cart;
    }

    function create(Customer $customer)
    {

        try {

            // create user cart
            $cart = Cart::create([
                'customer_id' => $customer->id
            ]);

            // membuat log mencatat create customer
            Log::info("Create Cart `customer username: " . $customer->user->username . " email: " . $customer->user->email . "` " . Carbon::now()->format('l, d F Y H:i:s'));
            return $cart;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function totalPaidPrice()
    {

        $cart = $this->getUserCart();

        // total seluruh harga yang dibayar
        return $cart->cart_items->sum(function ($item) {
            return $item->jumlah * $item->produk->harga;
        });
    }

    function deleteItem(Cart $cart)
    {
        try {

            $deleteItem = $cart->cart_items()->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
