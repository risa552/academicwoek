<?php

namespace App\Modules\Dgrade;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;
use App\Services\CurrentUser;


class DgradeController extends Controller
{
    public function index(Request $request)
    {
        $sub_id =$request->get('sub_id');

        $items = DB::table('enrolment')
        ->select('enrolment.*',
        'student.first_name',
        'student.last_name',
        'subject.sub_code',
        'subject.sub_name',
        'subject.sub_nameeng'

        )
        ->rightJoin('student','enrolment.std_id','student.std_id')
        ->leftJoin('subject','enrolment.sub_id','subject.sub_id')
        ->rightJoin('term','enrolment.term_id','term.term_id')
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('term')
                  ->where('startdate','<=',date('Y-m-d'))
                  ->where('enddate','>=',date('Y-m-d'))
                  ->whereRaw('enrolment.term_id = term.term_id');
        })
        ->whereNull('enrolment.delete_at')
        ->whereNull('term.delete_at')
        ->where('enrolment.sub_id','=',$sub_id)->get();

        $student  = DB::table('student')
        ->select('student.number','student.first_name','student.last_name');
        //->where('std_id',$std_id)->first();
    
   
        $subject = DB::table('subject')->whereNull('delete_at')->get();    
        // print_r($student);exit;   
        return view('dgrade::list',compact('items','student','subject'));
    }
    

}