<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    //
    public function index()
    {
        dd(app('request')->route()->getName());
    }
}
