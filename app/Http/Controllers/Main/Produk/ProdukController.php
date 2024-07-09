<?php

namespace App\Http\Controllers\Main\Produk;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Services\ProdukService;
use App\Http\Controllers\Controller;

class ProdukController extends Controller
{

    public function __construct(private ProdukService $produkService)
    {
    }
    public function list()
    {

        // data produk beserta kategori nya
        $dataProduk = $this->produkService->getAll();

        return view('main.produk.list', ['dataProduk' => $dataProduk]);
    }

    public function detail(Produk $produk)
    {

        return view('main.produk.detail', ['produk' => $produk]);
    }
}
