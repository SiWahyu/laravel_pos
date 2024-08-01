<?php

namespace App\Http\Controllers\Dashboard\Order;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\ProdukService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    public function __construct(
        private OrderService $orderService,
        private ProdukService $produkService
    ) {
    }
    public function data()
    {

        $dataOrder = $this->orderService->getAll();

        return view('dashboard.order.data', ['dataOrder' => $dataOrder]);
    }

    public function search(Request $request)
    {

        $order = null;

        if ($request->kode) {

            $order = $this->orderService->findByKode($request->kode);
        }

        return view('dashboard.order.search', ['order' => $order]);
    }

    public function checkoutTunai(Order $order)
    {

        try {
            $this->orderService->checkout($order);
        } catch (\Throwable $th) {
            Log::error('Error Konfirmasi Pembayaran : ' . $th->getMessage());
        }

        return back();
    }
}