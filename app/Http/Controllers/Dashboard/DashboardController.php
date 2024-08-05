<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\CustomerService;
use App\Services\KaryawanService;
use App\Services\KategoriService;
use App\Services\ProdukService;

class DashboardController extends Controller
{

    function __construct(
        private ProdukService $produkService,
        private CustomerService $customerService,
        private KaryawanService $karyawanService,
        private KategoriService $kategoriService

    ) {
    }
    public function index()
    {

        $totalProduk = $this->produkService->count();
        $totalCustomer = $this->customerService->count();
        $totalKaryawan = $this->karyawanService->count();
        $totalKategori = $this->kategoriService->count();

        return view('dashboard.main', ['totalCustomer' => $totalCustomer, 'totalProduk' => $totalProduk, 'totalKaryawan' => $totalKaryawan, 'totalKategori' => $totalKategori]);
    }
}