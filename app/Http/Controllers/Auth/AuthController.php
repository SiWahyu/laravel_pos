<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Services\AuthService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginPostRequest;
use App\Http\Requests\Auth\RegisterPostRequest;

class AuthController extends Controller
{

    function __construct(private AuthService $authService)
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

        try {

            // register user
            $user = $this->authService->registerUser($request->only(['username', 'email', 'password']));

            return redirect()->route('dashboard.index');
        } catch (\Throwable $th) {
            Log::error('Error Register User : ' . $th->getMessage() . " " . Carbon::now()->format('l, d F Y H:i:s'));
        }
    }
}