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
        $ggrade = DB::table('enrolment')
        ->select('enrolment.grade',
        'student.first_name',
        'student.last_name',
        'subject.sub_code',
        'subject.sub_name',
        'subject.sub_nameeng',
        'studygroup.group_name')
        ->leftJoin('student','student.std_id','enrolment.std_id')
        ->leftJoin('subject','subject.sub_id','enrolment.sub_id')
        ->leftJoin('educate','educate.sub_id','subject.sub_id')
        ->leftJoin('teacher','teacher.teach_id','educate.teach_id')
        ->leftJoin('studygroup','studygroup.group_id','student.group_id')
        ->where('teacher.teach_id',$user->teach_id)
        ->whereRaw(DB::raw('studygroup.group_id = educate.group_id'))
        ->whereNull('enrolment.delete_at')
        ->whereNull('student.delete_at')
        ->whereNull('subject.delete_at')
        ->whereNull('teacher.delete_at');
        
        if(!empty($keyword)){
            $ggrade->where(function ($query) use($keyword){
                $query->where('term_id','LIKE','%'.$keyword.'%');
            });
        }
        if(is_numeric($term_id))
        {
            $ggrade->where('enrolment.term_id','=',$term_id);
        }
        if(is_numeric($sub_id))
        {
            $ggrade->where('enrolment.sub_id','=',$sub_id);
        }
        if(is_numeric($group_id))
        {
            $ggrade->where('student.group_id','=',$group_id);
        }
       
        $ggrade = $ggrade->OrderBy('subject.sub_name','asc')->OrderBy('studygroup.group_name','asc')->get();
        $rom = DB::table('term')->whereNull('delete_at')->get();
        $rom1 = DB::table('subject')->whereNull('delete_at')->get();
        $rom2 = DB::table('studygroup')->whereNull('delete_at')->get();
        return view('ggrade::form',compact('ggrade','rom','rom1','rom2'));
    }

    public function store(Request $request)
    {
        $ggrade = $request->get('grade');
        if(!empty($ggrade) )
        {
            foreach($ggrade as $enro_id=>$g)
           DB::table('enrolment')->where('enro_id',$enro_id)->update([
                'ggrade'=>$ggrade,
            ]);
        }  
        return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/ggrade');
    }
}