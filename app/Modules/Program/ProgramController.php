<?php

namespace App\Modules\Program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;

class ProgramController extends Controller
{
    public function index()
    {
     return view('program::Program');
    }
}