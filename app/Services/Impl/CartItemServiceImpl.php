<?php

namespace App\Services\Impl;

use App\Models\Cart;
use App\Models\Produk;
use App\Models\CartItem;
use App\Services\CartItemService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CartItemServiceImpl implements CartItemService
{

    function findByProdukId(Produk $produk)
    {

        $customerId = Auth::user()->customer->id;

        $cartItem = CartItem::whereHas('cart', function ($query) use ($customerId) {
            $query->where('customer_id', $customerId);
        })
            ->where('produk_id', $produk->id)
            ->first();

        return $cartItem;
    }

    function create(Cart $cart, Produk $produk, array $data)
    {
        try {

            if ($cartItem = $this->findByProdukId($produk)) {

                if (($cartItem->jumlah + $data['jumlah_item']) > $cartItem->produk->stok) {
                    throw ValidationException::withMessages([
                        'jumlah_cart' => "Jumlah produk di cart melebihi jumlah stok"
                    ]);
                }

                $cartItem->jumlah += $data['jumlah_item'];
                return $cartItem->save();
            }

            return $cartItem = CartItem::create([
                'cart_id' => $cart->id,
                'produk_id' => $produk->id,
                'jumlah' => $data['jumlah_item']
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function delete(CartItem $cartItem)
    {
        try {

            return $cartItem->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
