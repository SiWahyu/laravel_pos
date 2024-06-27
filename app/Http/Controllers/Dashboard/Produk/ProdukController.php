<?php

namespace App\Http\Controllers\Dashboard\Produk;

use Carbon\Carbon;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Services\ProdukService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Produk\ProdukPostRequest;
use App\Http\Requests\Produk\ProdukPutRequest;

class ProdukController extends Controller
{

    public function __construct(private ProdukService $produkService)
    {
    }
    public function index()
    {

        // data produk dan kategori
        $dataProduk = $this->produkService->getAll();

        return view('dashboard.produk.index', ['dataProduk' => $dataProduk]);
    }

    public function create()
    {

        // data kategori
        $dataKategori = Kategori::all();

        return view('dashboard.produk.create', ['dataKategori' => $dataKategori]);
    }

    public function store(ProdukPostRequest $request)
    {

        try {

            // create data produk
            $produk = $this->produkService->create($request->validated());

            // membuat log mencatat update kategori
            Log::info("Create New Produk `$produk->nama` " . Carbon::now()->format('l, d F Y H:i:s'));
        } catch (\Throwable $th) {
            Log::error("Error Create Produk : " . $th->getMessage());
        }

        return redirect()->route('produk.data');
    }

    public function edit(Produk $produk)
    {

        $dataKategori = Kategori::all();

        return view('dashboard.produk.edit', ['produk' => $produk, 'kategori', 'dataKategori' => $dataKategori]);
    }

    public function update(ProdukPutRequest $request, Produk $produk)
    {

        try {

            // update produk
            $this->produkService->update($produk, $request->validated());

            // membuat log mencatat update produk
            Log::info("Update Produk `" . $request->validated('nama') . "` " . Carbon::now()->format('l, d F Y H:i:s'));
        } catch (\Throwable $th) {
            Log::error('Error Update Product : ' . $th->getMessage());
        }

        return redirect()->route('produk.data');
    }

    public function delete(Produk $produk)
    {

        try {

            // delete produk
            $this->produkService->delete($produk);

            // membuat log mencatat menghapus produk
            Log::info("Delete Produk `" . $produk->nama . "` " . Carbon::now()->format('l, d F Y H:i:s'));
        } catch (\Throwable $th) {
            Log::error("Error Delete Produk : " . $th->getMessage());
        }

        return back();
    }
}