<?php

namespace App\Services\Impl;

use Carbon\Carbon;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthServiceImpl implements AuthService
{


    function findUserByEmail(string $email)
    {

        return $user = User::where('email', $email)->first();
    }
    function authenticate(array $data)
    {

        $user = $this->findUserByEmail($data['email']);
        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password yang dimasukan salah'],
            ]);
        }

        Auth::login($user);

        // membuat log mencatat user login
        Log::info("User Login `username: " . $user->username . " email: " . $user->email . "` " . Carbon::now()->format('l, d F Y H:i:s'));

        return $user;
    }

    function logout()
    {

        $user = Auth::user();


        Auth::logout();
    }

    function registerUser(array $data)
    {
        DB::beginTransaction();

        try {

            $user = User::create([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            $user->syncRoles(['customer']);

            Auth::login($user);

            DB::commit();

            // membuat log mencatat register user
            Log::info("Register New User `username: " . $user->username . " email: " . $user->email . "` " . Carbon::now()->format('l, d F Y H:i:s'));
            // membuat log mencatat user login
            Log::info("User Login `username: " . $user->username . " email: " . $user->email . "` " . Carbon::now()->format('l, d F Y H:i:s'));

            return $user;
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
        }
    }
}