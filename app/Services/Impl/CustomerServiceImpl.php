<?php

namespace App\Services\Impl;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Support\Facades\Log;

class CustomerServiceImpl implements CustomerService
{

    function getAll()
    {
        $dataCutomer = Customer::with(['user'])->get();

        return $dataCutomer;
    }

    function delete(Customer $customer)
    {

        try {

            $userCustomer = $customer->user;

            $userCustomer->delete();

            Log::info("Create User `username: $userCustomer->username email: $userCustomer->email role: Customer` " . Carbon::now()->format('l, d F Y H:i:s'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function create(User $user)
    {

        try {

            $customer = Customer::create([
                'user_id' => $user->id
            ]);

            // membuat log mencatat create customer
            Log::info("Create Customer `username: " . $user->username . " email: " . $user->email . "` " . Carbon::now()->format('l, d F Y H:i:s'));

            return $customer;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
