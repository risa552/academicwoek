<?php

namespace App\Modules\Cou;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;

class CouController extends Controller
{
    public function index()
    {
     return view('cou::Cou');
    }
    public function editcou()
    {
     return view('cou::editcou');
    }
    public function fromcou()
    {
     return view('cou::fromcou');
    }
}