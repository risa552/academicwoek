<?php

namespace App\Modules\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;

class StudentController extends Controller
{
    public function index()
    {
     return view('student::Student');
    }
    public function fromstu()
    {
     return view('student::fromstu');
    }
    public function editstu()
    {
     return view('student::editstu');
    }
}
