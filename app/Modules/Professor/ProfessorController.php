<?php

namespace App\Modules\Professor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;

class ProfessorController extends Controller
{
    public function index()
    {
     return view('pro::professor');
    }
    public function proedit()
    {
     return view('pro::proedit');
    }
}