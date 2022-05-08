<?php

namespace App\Http\Controllers\Auth;

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

    public function attempt(Request $request)
    {
        $request->all();
    }
}
