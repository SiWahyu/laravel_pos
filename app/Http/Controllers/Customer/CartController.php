<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CartPostRequest;
use App\Models\Produk;
use App\Services\CartItemService;
use App\Services\CartService;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{

    public function __construct(private CartService $cartService, private CartItemService $cartItemService)
    {
    }
    public function index()
    {

        $cart = $this->cartService->getUserCart();

        return view('customer.cart.index', ['cart' => $cart, 'totalHarga' => $this->cartService->totalPaidPrice()]);
    }

    public function store(CartPostRequest $request, Produk $produk)
    {

        try {

            $this->cartItemService->create($this->cartService->getUserCart(), $produk, $request->validated());
            return back();
        } catch (\Throwable $th) {
            Log::error('Error Create Cart Item : ' . $th->getMessage());
            return back()->withErrors(["jumlah_item_cart" => $th->getMessage()]);
        }
    }
}
