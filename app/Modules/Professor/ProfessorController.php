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
     return view('professor::Professor');
    }
    public function proform()
    {
     return view('professor::proform');
    }
    public function proedit()
    {
     return view('professor::proedit');
    }
}
