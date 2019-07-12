<?php

namespace App\Modules\Degree;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;

class DegreeController extends Controller
{
    public function index()
    {
     return view('degree::Degree');
    }
    public function fromde()
    {
     return view('degree::fromde');
    }
    public function editde()
    {
     return view('degree::editde');
    }
}
