<?php

namespace App\Modules\Plan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;
use App\Services\CurrentUser;


class PlanController extends Controller
{
    public function show($std_id,Request $request)
    {
        $items = DB::table('enrolment')
        ->select('enrolment.*',
        'subject.sub_code',
        'subject.sub_name',
        'term.term_name',
        'term.year')
        ->rightJoin('subject','enrolment.sub_id','subject.sub_id')
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
        ->where('enrolment.std_id','=',$std_id)->get();

        $student  = DB::table('student')
        ->select('student.number','student.first_name','student.last_name')
        ->where('std_id',$std_id)->first();
        

        // $items = $items->orderBy('enrolment.created_at','asc')->get();
        // $student = DB::table('student')->whereNull('delete_at')->get();
        // $program = DB::table('program')->whereNull('delete_at')->get();
        // $subject = DB::table('subject')->whereNull('delete_at')->get();
           // print_r($student);exit;
        return view('plan::list',compact('items','student'));
    }

    public function create()
    {
       
        return view('plan::form');
    }
    
   
}