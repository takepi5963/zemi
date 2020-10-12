<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response; //追記

class LoginController extends Controller
{
    //
    public function login (Request $request, Response $response)
    {
        return view('login');
    }
}
