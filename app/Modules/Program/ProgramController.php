<?php

namespace App\Modules\Program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;

class LoginController extends Controller
{
    public function index()
    {
     return view('Program::Program');
    }
}