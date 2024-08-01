<?php

namespace App\Services\Impl;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Produk;
use Illuminate\Support\Str;
use App\Services\OrderService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class OrderServiceImpl implements OrderService
{

    function getAll()
    {
        $orders = Order::with('order_items')->get();

        return $orders;
    }

    function getUserOrder()
    {
        $orders = Order::where('customer_id', Auth::user()->customer->id)->with('order_items')->get();

        return $orders;
    }

    function findByKode(string $kode)
    {
        $order = Order::where('kode', $kode)->with('order_items')->first();

        return $order;
    }

    function create(Cart $cart, string $pembayaran)
    {
        $order = Order::create([
            'kode' => "OR-" . strtoupper(Str::random(12)),
            'customer_id' => $cart->customer_id,
            'status' => 'Pending',
            'pembayaran' => $pembayaran,
            'total' => $cart->cart_items->sum(function ($item) {
                return $item->jumlah * $item->produk->harga;
            })
        ]);

        return $order;
    }


    function updateStatus(Order $order, string $status)
    {

        try {

            $order->status = $status;

            Log::info("Order $status `kode: " . $order->kode . " total: " . $order->total . "` " . Carbon::now()->format('l, d F Y H:i:s'));

            return $order->save();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function checkout(Order $order)
    {

        DB::beginTransaction();
        try {

            foreach ($order->order_items as $item) {

                $produk = Produk::where('id', $item->produk->id)->lockForUpdate()->first();
                if (($produk->stok > 0) && ($produk->stok >= $item->jumlah)) {

                    $produk->stok -= $item->jumlah;

                    DB::commit();

                    $this->updateStatus($order, 'Paid');

                    $update = $produk->save();

                    return $update;
                } else {

                    DB::rollBack();

                    $this->updateStatus($order, 'Stock Insufficient');

                    throw new \Exception("Stok produk $produk->nama tidak cukup");
                }
            }
        } catch (\Throwable $th) {
            DB::rollBack();

            $this->updateStatus($order, 'Failed');

            throw $th;
        }
    }
}