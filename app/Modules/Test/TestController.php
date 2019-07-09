<?php

namespace App\Modules\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;

class TestController extends Controller
{
    public function index()
    {
     return view('test::test');
    }
}