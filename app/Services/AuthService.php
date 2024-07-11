<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\User;

interface AuthService
{

    function findUserByEmail(string $email);

    function authenticate(array $data);

    function logout();

    function registerCustomer(User $user, Customer $customer);
}
