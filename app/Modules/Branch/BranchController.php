<?php

namespace App\Modules\Branch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;

class BranchController extends Controller
{
    public function index()
    {
    return view('branch::Branch');
    }
    public function frombranch()
    {
    return view('branch::frombranch');
    }
    public function editbranch()
    {
    return view('branch::editbranch');
    }
}