<?php

namespace App\Services;

use App\Models\Karyawan;

interface KaryawanService
{

    function getAll();

    function create(array $data);

    function update(Karyawan $karyawan, array $data);

    function delete(Karyawan $karyawan);

    function count(): int;
}