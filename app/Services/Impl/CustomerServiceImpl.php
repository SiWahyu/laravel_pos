<?php

namespace App\Services\Impl;

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

            return $customer->user()->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
