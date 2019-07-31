<?php

namespace App\Modules\EnrolmentStudent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class EnrolmentStudentController extends Controller
{
    public function index()
    {
        return view ('enrostudent::list');
    }
}
?>