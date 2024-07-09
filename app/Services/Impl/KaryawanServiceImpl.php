<?php

namespace App\Services\Impl;

use Carbon\Carbon;
use App\Models\Karyawan;
use Illuminate\Support\Str;
use App\Services\UserService;
use App\Services\KaryawanService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KaryawanServiceImpl implements KaryawanService
{

    public function __construct(private UserService $userService)
    {
    }
    function getAll()
    {

        $dataKaryawan = Karyawan::with(['user'])->get();

        return $dataKaryawan;
    }

    function create(array $data)
    {
        DB::beginTransaction();

        try {

            $user = $this->userService->create([
                'username' => $data['nama'],
                'email' => $data['email'],
                'password' =>  Str::lower(preg_replace('/\s+/', '', $data['nama']))
            ]);


            // create data karyawan
            $karyawan = Karyawan::create(attributes: [
                'user_id' => $user->id,
                'nama' => $data['nama'],
                'telepon' => $data['telepon'],
                'posisi' => $data['posisi'],
            ]);

            $user->syncRoles($karyawan->posisi);

            // membuat log mencatat create user
            Log::info("Create User `username: $user->username email: $user->email role: $karyawan->posisi` " . Carbon::now()->format('l, d F Y H:i:s'));

            // membuat log mencatat create karyawan
            Log::info("Create Karyawan `nama: $karyawan->nama telepon: $karyawan->telepon  email: $karyawan->email  posisi: $karyawan->posisi` " . Carbon::now()->format('l, d F Y H:i:s'));

            DB::commit();

            return $karyawan;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    function update(Karyawan $karyawan, array $data)
    {

        try {

            $update = $karyawan->update([
                'user_id' => $karyawan->user->id,
                'nama' => $data['nama'],
                'posisi' => $data['posisi'],
                'telepon' => $data['telepon'],
            ]);

            $karyawan->user->email = $data['email'];
            $karyawan->user->password =  Str::lower(preg_replace('/\s+/', '', $data['nama']));
            $karyawan->user->save();

            // membuat log mencatat update karyawan
            Log::info("Update Karyawan `nama: $data[nama]  telepon: $data[telepon]  email: $data[email] posisi: $data[posisi]` " . Carbon::now()->format('l, d F Y H:i:s'));

            // membuat log mencatat create user
            Log::info("Update User `username: $data[nama]  email: $data[email]  role: $data[posisi]` " . Carbon::now()->format('l, d F Y H:i:s'));

            return $update;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function delete(Karyawan $karyawan)
    {

        try {

            $user = $karyawan->user;

            $karyawan->user->delete();

            // membuat log mencatat menghapus karyawan
            Log::info("Delete Karyawan `nama: $karyawan->nama  telepon: $karyawan->telepon  email: $user->email  posisi: $karyawan->posisi ` " . Carbon::now()->format('l, d F Y H:i:s'));

            return $karyawan->user ? $karyawan->user()->delete() : $karyawan->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
