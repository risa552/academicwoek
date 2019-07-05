<?php

namespace App\Modules\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;

class LoginController extends Controller
{
    public function index()
    {
     return view('log::login');
    }
}