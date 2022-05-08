<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    protected $title = 'Dashboard';

    private $baseView = 'pages.admin.';

    public function index()
    {
        return view(
            $this->baseView . 'dashboard',
            $this->getData()
        );
    }
}
