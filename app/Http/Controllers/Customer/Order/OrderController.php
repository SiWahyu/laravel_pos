<?php

namespace App\Http\Controllers\Customer\Order;

use Illuminate\Http\Request;
use App\Services\CartService;
use App\Services\OrderService;
use App\Services\OrderItemService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{

    public function __construct(
        private CartService $cartService,
        private OrderService $orderService,
        private OrderItemService $orderItemService,
    ) {
    }

    public function data()
    {

        $orderData = $this->orderService->getUserOrder();

        return view('customer.order.data', ['orderData' => $orderData]);
    }

    public function checkout(Request $request)
    {

        $cart = $this->cartService->getUserCart();

        try {

            $order = $this->orderService->create($cart, $request->pembayaran);

            $orderItem = $this->orderItemService->create($order, $cart);

            $this->cartService->deleteItem($cart);
        } catch (\Throwable $th) {
            Log::error('Error Create Order : ' . $th->getMessage());
        }
        return redirect()->route('customer.order.detail', $order->kode);
    }

    public function detail(string $kode)
    {

        $order = $this->orderService->findByKode($kode);

        if (!$order) {

            abort(404);
        }

        return view('customer.order.detail', ['order' => $order]);
    }
}