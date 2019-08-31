<?php

namespace App\Modules\Ggrade;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;
use App\Services\CurrentUser;


class GgradeController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $term_id = $request->get('term_id');
        $sub_id = $request->get('sub_id');
        $group_id = $request->get('group_id');

        $user=CurrentUser::user();
        $ggrade = DB::table('educate')
        ->select('educate.*',
        'subject.sub_name',
        'student.first_name',
        'student.last_name',
        'student.number',
        'enrolment.enro_id',
        'enrolment.score',
        'enrolment.grade',
        'program.term_id',
        'studygroup.group_name')
        ->leftjoin('program', function ($join) {
            $join->on('program.term_id', '=', 'educate.term_id')
                 ->on('program.sub_id', '=', 'educate.sub_id');
        })
        ->leftJoin('subject','program.sub_id','subject.sub_id')
        ->leftJoin('enrolment','enrolment.program_id','program.program_id')
        ->rightJoin('student','enrolment.std_id','student.std_id')
        ->leftJoin('studygroup','studygroup.group_id','student.group_id')
        ->where('educate.teach_id',$user->teach_id)
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
            $ggrade->where(function ($query) use($keyword){
                $query->where('first_name','LIKE','%'.$keyword.'%')
                      ->orwhere('last_name','LIKE','%'.$keyword.'%')
                      ->orwhere('number','LIKE','%'.$keyword.'%');
            });
        }
        if(is_numeric($term_id))
        {
            $ggrade->where('program.term_id','=',$term_id);
        }
        if(is_numeric($sub_id))
        {
            $ggrade->where('program.sub_id','=',$sub_id);
        }
        if(is_numeric($group_id))
        {
            $ggrade->where('student.group_id','=',$group_id);
        }
         // print_r($ggrade);exit;
        $ggrade = $ggrade->get();
        $rom = DB::table('term')->whereNull('delete_at')->get();
        $rom1 = DB::table('subject')->whereNull('delete_at')->get();
        $rom2 = DB::table('studygroup')->whereNull('delete_at')->get();
        return view('ggrade::form',compact('ggrade','rom','rom1','rom2'));
    }

    public function store(Request $request)
    {
        $ggrade = $request->get('ggrade');
        if(!empty($ggrade) && is_array($ggrade))
        {
            foreach($ggrade as $enro_id=>$g)
           DB::table('enrolment')->where('enro_id',$enro_id)->update([
                'ggrade'=>$g,
            ]);
        }  
        return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/ggrade');
    }
}