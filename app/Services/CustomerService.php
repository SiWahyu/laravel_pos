<?php

namespace App\Services;

use App\Models\Customer;

interface CustomerService
{

    function getAll();

    function delete(Customer $customer);
}
