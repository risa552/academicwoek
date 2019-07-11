<?php

namespace App\Modules\Teaching;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;

class TeachingController extends Controller
{
    public function index()
    {
    return view('teaching::Teaching');
    }
    public function fromtea()
    {
    return view('teaching::fromtea');
    }
    public function edittea()
    {
    return view('teaching::edittea');
    }
}