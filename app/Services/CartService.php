<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Customer;

interface CartService
{

    function getUserCart();

    function create(Customer $customer);

    function totalPaidPrice();

    function deleteItem(Cart $cart);
}
