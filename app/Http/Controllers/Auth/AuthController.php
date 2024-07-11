<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Services\AuthService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginPostRequest;
use App\Http\Requests\Auth\RegisterPostRequest;
use App\Services\CartService;
use App\Services\CustomerService;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    function __construct(private AuthService $authService, private UserService $userService, private CustomerService $customerService, private CartService $cartService)
    {
    }

    public function login()
    {

        return view('auth.login');
    }

    public function authenticate(LoginPostRequest $request)
    {

        try {

            // validated user
            $user = $this->authService->authenticate($request->validated());

            return redirect()->route('dashboard.index');
        } catch (\Throwable $th) {

            return back()->withErrors(['email' => $th->getMessage()])->onlyInput('email');
        }
    }

    public function logout()
    {

        // user logout
        $this->authService->logout();

        return redirect()->route('login');
    }

    public function register()
    {

        return view('auth.register');
    }

    public function registerUser(RegisterPostRequest $request)
    {

        DB::beginTransaction();
        try {

            // register user
            $user = $this->userService->create($request->only(['username', 'email', 'password']));

            // create customer
            $customer = $this->customerService->create($user);

            // crate user cart
            $cart = $this->cartService->create($customer);

            // register role user sebagai customer
            $this->authService->registerCustomer($user, $customer);

            DB::commit();

            return redirect()->route(route: 'dashboard.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error Register User : ' . $th->getMessage() . " " . Carbon::now()->format('l, d F Y H:i:s'));
        }
    }
}
