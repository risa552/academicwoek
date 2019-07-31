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
        $items = DB::table('enrolment')
        ->select('enrolment.*','student.std_fname','program.program_name')
        ->leftJoin('student','enrolment.std_id','student.std_id')
        ->leftJoin('program','enrolment.program_id','program.program_id')
        ->whereNull('enrolment.delete_at');

        return view ('enrostudent::list');
    }
}
?>