<?php

namespace App\Modules\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;

class AdminController extends Controller
{
    public function index()
    {
     return view('admin::Admin');
    }
    public function fromadmin()
    {
     return view('admin::fromadmin');
    }
}