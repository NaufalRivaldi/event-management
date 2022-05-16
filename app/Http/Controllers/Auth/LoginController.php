<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    protected $title = 'Login';

    private $baseView = 'pages.auth.';

    public function login()
    {
        return view(
            $this->baseView . 'login',
            $this->getData()
        );
    }

    public function register()
    {
        return view(
            $this->baseView . 'register',
            array_merge(
                $this->getData(),
                [
                    'title' => __('Register'),
                ]
            )
        );
    }

    public function attempt(LoginRequest $request)
    {
        $inputs = $request->validated();
        $inputs['status'] = 1;

        if (Auth::attempt($inputs)) {
            $request->session()->regenerate();

            return to_route('admin.dashboard');
        }

        return back()
            ->withErrors([
                'email' => __('The provided credentials do not match our records.'),
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return to_route('admin.login');
    }
}
