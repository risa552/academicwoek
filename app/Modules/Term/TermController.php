<?php

namespace App\Modules\Term;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;

class TermController extends Controller
{
    public function index()
    {
    return view('term::Term');
    }
    public function fromterm()
    {
    return view('term::fromterm');
    }
    public function editterm()
    {
    return view('term::editterm');
    }
}