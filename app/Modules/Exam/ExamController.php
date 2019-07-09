<?php

namespace App\Modules\Exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;

class ExamController extends Controller
{
    public function index()
    {
     return view('exam::exam');
    }
    public function from()
    {
     return view('exam::from');
    }
}