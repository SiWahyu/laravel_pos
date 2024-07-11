<?php

namespace App\Services\Impl;

use Carbon\Carbon;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;


class UserServiceImpl implements UserService
{

    function create(array $data): User
    {
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // membuat log mencatat register user
        Log::info("Create User `username: $user->username email: $user->email role: Customer` " . Carbon::now()->format('l, d F Y H:i:s'));

        return $user;
    }

    function delete(User $user)
    {
        return $user->delete();
    }
}
