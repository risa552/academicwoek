<?php

namespace App\Modules\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;

class CourseController extends Controller
{
    public function index()
    {
     return view('cou::course');
    }
}