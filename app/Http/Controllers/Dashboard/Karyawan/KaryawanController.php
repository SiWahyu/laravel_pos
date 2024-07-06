<?php

namespace App\Http\Controllers\Dashboard\Karyawan;

use App\Http\Controllers\Controller;
use App\Http\Requests\Karyawan\KaryawanPostRequest;
use App\Http\Requests\Karyawan\KaryawanPutRequest;
use App\Models\Karyawan;
use App\Services\KaryawanService;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KaryawanController extends Controller
{

    public function __construct(private KaryawanService $karyawanService, private RoleService $roleService)
    {
    }
    public function index()
    {

        $dataKaryawan = $this->karyawanService->getAll();

        return view('dashboard.karyawan.index', ['dataKaryawan' => $dataKaryawan]);
    }

    public function create()
    {

        $dataPosisi = $this->roleService->getAssignableRoles();

        return view('dashboard.karyawan.create', ['dataPosisi' => $dataPosisi]);
    }
    public function store(KaryawanPostRequest $request)
    {

        try {

            // create user
            $karyawan = $this->karyawanService->create($request->validated());
        } catch (\Throwable $th) {
            Log::error("Error Create Karyawan : " . $th->getMessage());
        }

        return redirect()->route('karyawan.data');
    }

    public function edit(Karyawan $karyawan)
    {

        $dataPosisi = $this->roleService->getAssignableRoles();

        return view('dashboard.karyawan.edit', ['karyawan' => $karyawan, 'dataPosisi' => $dataPosisi]);
    }

    function update(Karyawan $karyawan, KaryawanPutRequest $request)
    {


        try {

            $this->karyawanService->update($karyawan, $request->validated());
        } catch (\Throwable $th) {
            Log::error("Error Update Karyawan : " . $th->getMessage());
        }
        return redirect()->route('karyawan.data');
    }

    public function delete(Karyawan $karyawan)
    {

        try {

            // delete karyawan
            $this->karyawanService->delete($karyawan);
        } catch (\Throwable $th) {
            Log::error("Error Delete Karyawan : " . $th->getMessage());
        }

        return back();
    }
}
