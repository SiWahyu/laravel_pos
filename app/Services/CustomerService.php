<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\User;

interface CustomerService
{

    function getAll();

    function delete(Customer $customer);

    function create(User $user);
}
