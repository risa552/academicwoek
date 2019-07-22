<?php

namespace App\Modules\Rights;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;

class RightsController extends Controller
{
    public function index()
    {
     return view('rights::Rights');
    }
    public function fromrig()
    {
     return view('rights::fromrig');
    }
    public function editrig()
    {
     return view('rights::editrig');
    }
}