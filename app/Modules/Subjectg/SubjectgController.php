<?php

namespace App\Modules\Subjectg;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;

class SubjectgController extends Controller
{
    public function index()
    {
     return view('subjectg::Subjectg');
    }
    public function fromsubjectg()
    {
     return view('subjectg::fromsubjectg');
    }
    public function editsubjectg()
    {
     return view('subjectg::editsubjectg');
    }
}