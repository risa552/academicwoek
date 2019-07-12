<?php

namespace App\Modules\Teach;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;

class TeachController extends Controller
{
    public function index()
    {
     return view('teach::Teach');
    }
    public function fromte()
    {
     return view('teach::fromte');
    }
    public function editte()
    {
     return view('teach::editte');
    }
}
