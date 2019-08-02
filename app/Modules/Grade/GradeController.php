<?php

namespace App\Modules\Grade;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;
use App\Services\CurrentUser;

class GradeController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $term_id = $request->get('term_id');

        $user=CurrentUser::user();
        $grade = DB::table('program')
        ->select('program.program_id',
        'subject.sub_code',
        'subject.sub_name',
        'student.first_name',
        'student.last_name',
        'enrolment.grade')
        ->leftJoin('subject','program.sub_id','subject.sub_id')
        ->leftJoin('enrolment','enrolment.program_id','program.program_id')
        ->rightJoin('student','enrolment.std_id','student.std_id')
    
        ->where('program.teach_id',$user->teach_id)
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('term')
                  ->where('startdate','<=',date('Y-m-d'))
                  ->where('enddate','>=',date('Y-m-d'))
                  ->whereRaw('program.term_id = term.term_id');
        })
        ->whereNull('program.delete_at')
        ->whereNull('student.delete_at')
        ->whereNull('enrolment.delete_at');

        if(!empty($keyword)){
            $grade->where(function ($query) use($keyword){
                $query->where('term_id','LIKE','%'.$keyword.'%');
            });
        }
        if(is_numeric($term_id))
        {
            $grade->where('program.term_id','=',$term_id);
        }
         // print_r($grade);exit;
        $grade = $grade->get();
        $rom = DB::table('term')->whereNull('delete_at')->get();
        return view('grade::form',compact('grade','rom'));
    }
}