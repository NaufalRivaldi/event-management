<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class BaseController extends Controller
{
    protected $title;

    protected function getData(array $data = []): array
    {
        return array_merge(
            [
                'title' => Str::title(__($this->title)),
            ],
            $data
        );
    }
}
