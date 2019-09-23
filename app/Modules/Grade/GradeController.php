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
        $sub_id = $request->get('sub_id');
        $group_id = $request->get('group_id');

        $user=CurrentUser::user();
        $grade = DB::table('educate')
        ->select('educate.*',
        'subject.sub_code', 
        'subject.sub_name',
        'enrolment.enro_id',
        'enrolment.score',
        'enrolment.grade',
        'studygroup.group_name')
        ->leftjoin('program', function ($join) {
            $join->on('program.term_id', '=', 'educate.term_id')
                 ->on('program.sub_id', '=', 'educate.sub_id');
        })
        //->rightJoin('subject','enrolment.sub_id','subject.sub_id')
        ->leftJoin('subject','program.sub_id','subject.sub_id')
        ->rightJoin('enrolment','enrolment.sub_id','subject.sub_id')
        ->rightJoin('student','enrolment.std_id','student.std_id')
        ->leftJoin('studygroup','studygroup.group_id','program.group_id')
        ->leftJoin('teacher','studygroup.group_id','program.group_id')
        ->where('educate.teach_id',$user->teach_id)
        ->where('enrolment.status','=','ปกติ')
        ->whereExists(function ($query) { 
            $query->select(DB::raw(1))
                  ->from('term')
                  ->where('startdate','<=',date('Y-m-d'))
                  ->where('enddate','>=',date('Y-m-d'))
                  ->whereRaw('program.term_id = term.term_id');
        })
        ->whereNull('program.delete_at')
        ->whereNull('studygroup.delete_at')
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
        if(is_numeric($sub_id))
        {
            $grade->where('program.sub_id','=',$sub_id);
        }
        if(is_numeric($group_id))
        {
            $grade->where('student.group_id','=',$group_id);
        }
          //print_r($g1);exit;*/
        $grade = $grade->get();
        $rom = DB::table('term')->whereNull('delete_at')->get();
        $rom1 = DB::table('subject')->whereNull('delete_at')->get();
        $rom2 = DB::table('studygroup')->whereNull('delete_at')->get();
        return view('grade::form',compact('grade','rom','rom1','rom2'));
    }

    public function store(Request $request)
    {
        $score = $request->get('score');
        $grade = $request->get('grade');
        if(!empty($grade) && is_array($grade) && !empty($score) && is_array($score))
        {
            foreach($grade as $enro_id=>$g)
           DB::table('enrolment')->where('enro_id',$enro_id)->update([
                'grade'=>$g,
            ]);
            foreach($score as $enro_id=>$s)
            DB::table('enrolment')->where('enro_id',$enro_id)->update([
                 'score'=>$s,
             ]);
        }  
        return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/grade');
    }
}