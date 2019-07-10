<?php

namespace App\Modules\Sub;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;

class SubController extends Controller
{
    public function index()
    {
    return view('sub::Sub');
    }
    public function fromsub()
    {
    return view('sub::fromsub');
    }
    public function editsub()
    {
    return view('sub::editsub');
    }
}