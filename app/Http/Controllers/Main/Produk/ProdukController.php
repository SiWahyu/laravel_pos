<?php

namespace App\Http\Controllers\Main\Produk;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Services\ProdukService;
use App\Http\Controllers\Controller;
use App\Services\KategoriService;

class ProdukController extends Controller
{

    public function __construct(private ProdukService $produkService, private KategoriService $kategoriService)
    {
    }
    public function list(Request $request)
    {

        // data produk
        $dataProduk = null;

        $dataKategori = $this->kategoriService->getAll();

        if ($filter = $request->only(['kategori', 'nama'])) {

            // data produk beserta kategori yang sudah di filter
            $dataProduk = $this->produkService->getFiltered($filter);
        } else {

            // semua data produk beserta kategori nya
            $dataProduk = $this->produkService->getAll();
        }

        return view('main.produk.list', ['dataProduk' => $dataProduk, 'dataKategori' => $dataKategori]);
    }

    public function detail(Produk $produk)
    {

        return view('main.produk.detail', ['produk' => $produk]);
    }
}
