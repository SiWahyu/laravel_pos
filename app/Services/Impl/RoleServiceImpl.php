<?php

namespace App\Services\Impl;

use App\Services\RoleService;
use Spatie\Permission\Models\Role;

class RoleServiceImpl implements RoleService
{


    // Mengambil role untuk karyawan
    function getAssignableRoles()
    {
        $dataRole = Role::whereNotIn('name', ['admin', 'customer'])->get();

        return $dataRole;
    }
}
