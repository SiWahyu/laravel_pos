<?php

namespace App\Http\Controllers\Dashboard\Kategori;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Services\KategoriService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kategori\KategoriPostRequest;
use App\Http\Requests\Kategori\KategoriPutRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class KategoriController extends Controller
{

    public function __construct(private KategoriService $kategoriService)
    {
    }

    public function index()
    {

        // data kategori
        $dataKategori = Kategori::all();

        return view('dashboard.kategori.index', ['dataKategori' => $dataKategori]);
    }

    public function create()
    {

        return view('dashboard.kategori.create');
    }

    public function store(KategoriPostRequest $request)
    {

        try {

            // create kategori
            $create = $this->kategoriService->create($request->validated());

            // membuat log mencatat kategori baru
            Log::info("Create New Kategori `$create->nama` " . Carbon::now()->format('l, d F Y H:i:s'));
        } catch (\Throwable $th) {
            Log::error("Error Create Kategori : " . $th->getMessage());
        }

        return redirect()->route('kategori.data');
    }

    public function edit(Kategori $kategori)
    {

        return view('dashboard.kategori.edit', ['kategori' => $kategori]);
    }

    public function update(KategoriPutRequest $request, Kategori $kategori)
    {

        try {

            // update kategori
            $this->kategoriService->update($kategori, $request->validated());

            // membuat log mencatat update kategori
            Log::info("Update Kategori `" . $request->validated('nama') . "` " . Carbon::now()->format('l, d F Y H:i:s'));
        } catch (\Throwable $th) {
            Log::error("Error Update Kategori : " . $th->getMessage());
        }

        return redirect()->route('kategori.data');
    }

    public function delete(Kategori $kategori)
    {

        try {

            // delete kategori
            $this->kategoriService->delete($kategori);

            // membuat log mencatat menghapus kategori
            Log::info("Delete Kategori `" . $kategori->nama . "` " . Carbon::now()->format('l, d F Y H:i:s'));
        } catch (\Throwable $th) {
            Log::error("Error Delete Kategori : " . $th->getMessage());
        }

        return back();
    }
}