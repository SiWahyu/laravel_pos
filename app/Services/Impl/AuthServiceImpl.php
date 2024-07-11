<?php

namespace App\Services\Impl;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Customer;
use App\Services\AuthService;
use App\Services\CustomerService;
use App\Services\UserService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthServiceImpl implements AuthService
{

    public function __construct(private UserService $userService, private CustomerService $customerService)
    {
    }

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

    function registerCustomer(User $user, Customer $customer)
    {
        try {

            $user->syncRoles(['customer']);

            // auth user yang baru register
            Auth::login($user);

            // membuat log mencatat user login
            Log::info("User Login `username: " . $user->username . " email: " . $user->email . "` " . Carbon::now()->format('l, d F Y H:i:s'));

            return $user;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
