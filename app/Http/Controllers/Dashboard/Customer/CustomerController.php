<?php

namespace App\Http\Controllers\Dashboard\Customer;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Services\CustomerService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{

    function __construct(
        private CustomerService $customerService
    ) {
    }
    public function index()
    {

        // data customer
        $dataCutomer = $this->customerService->getAll();

        return view('dashboard.customer.index', ['dataCustomer' => $dataCutomer]);
    }

    public function delete(Customer $customer)
    {

        try {

            // delete data customer
            $this->customerService->delete($customer);
        } catch (\Throwable $th) {

            Log::error('Error Delete Customer : ' . $th->getMessage());
        }

        return redirect()->back();
    }
}
