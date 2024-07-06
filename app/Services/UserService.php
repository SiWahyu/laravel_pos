<?php

namespace App\Services;

use App\Models\User;


interface UserService
{
    function create(array $data): User;

    function delete(User $user);
}
