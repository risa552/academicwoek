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
        //DB::enableQueryLog();
        $items = DB::table('educate')
        ->select('educate.*',
        'subject.sub_code',
        'subject.sub_name',
        'subject.sub_name_eng',
        'studygroup.group_name')
        ->leftJoin('subject','subject.sub_id','educate.sub_id')
        ->leftJoin('teacher','teacher.teach_id','educate.teach_id')
        ->leftJoin('studygroup','studygroup.group_id','educate.group_id')
        ->where('teacher.teach_id',$user->teach_id)
        ->whereRaw(DB::raw('studygroup.group_id = educate.group_id'))
        ->whereNull('educate.delete_at')
        ->whereNull('subject.delete_at')
        ->whereNull('teacher.delete_at');
        
        
        if(!empty($keyword)){
            $items->where(function ($query) use($keyword){
                $query->where('term_id','LIKE','%'.$keyword.'%');
            });
        }
        if(is_numeric($term_id))
        {
            $items->where('educate.term_id','=',$term_id);
        }
        if(is_numeric($sub_id))
        {
            $items->where('educate.sub_id','=',$sub_id);
        }
        if(is_numeric($group_id))
        {
            $items->where('educate.group_id','=',$group_id);
        }
        $items = $items->OrderBy('subject.sub_name','asc')
        ->OrderBy('studygroup.group_name','asc')->paginate(10);
       //// print_r(DB::getQueryLog());exit;

        $rom = DB::table('term')->whereNull('delete_at')->get();
        $rom1 = DB::table('subject')
        ->leftJoin('educate','educate.sub_id','subject.sub_id')
        ->where('educate.teach_id',$user->teach_id)
        ->whereNull('subject.delete_at')
        ->get();
        $rom2 = DB::table('studygroup')->whereNull('delete_at')->get();
        return view('grade::form',compact('items','rom','rom1','rom2'));
    }
    public function show($educate_id,Request $request)
    {
        $keyword = $request->get('keyword');
       
        $user=CurrentUser::user();
        //DB::enableQueryLog();
        $grade = DB::table('enrolment')
        ->select('enrolment.*',
        'student.first_name',
        'student.last_name',
        'subject.sub_code',
        'subject.sub_name',
        'subject.sub_name_eng',
        'studygroup.group_name')
        ->leftJoin('student','student.std_id','enrolment.std_id')
        ->leftJoin('subject','subject.sub_id','enrolment.sub_id')
        ->leftJoin('educate','educate.sub_id','subject.sub_id')
        ->leftJoin('teacher','teacher.teach_id','educate.teach_id')
        ->leftJoin('studygroup','studygroup.group_id','student.group_id')
        ->where('teacher.teach_id',$user->teach_id)
        ->where('educate.educate_id',$educate_id)
        ->whereRaw(DB::raw('studygroup.group_id = educate.group_id'))
        ->whereNull('enrolment.delete_at')
        ->whereNull('student.delete_at')
        ->whereNull('subject.delete_at')
        ->whereNull('teacher.delete_at');
        
        $subject = DB::table('subject')
        ->select('subject.*',
        'studygroup.group_name')
        ->leftJoin('educate','educate.sub_id','subject.sub_id')
        ->leftJoin('studygroup','educate.group_id','studygroup.group_id')
        ->where('educate.educate_id',$educate_id)
        ->whereNull('subject.delete_at')->first();

        $grade = $grade->OrderBy('studygroup.group_name','asc')
        ->OrderBy('studygroup.group_name','asc')->paginate(10);
       //// print_r(DB::getQueryLog());exit;

        
        return view('grade::list',compact('grade','subject','educate_id'));
    }

    public function store(Request $request)
    {
        $grades = $request->get('grade');
        if(!empty($grades) && is_array($grades))
        {
            foreach($grades as $enro_id=>$grade){
                DB::table('enrolment')->where('enro_id',$enro_id)->update([
                    'grade'=>$grade,
                ]);
            }
        }  
        return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/grade');
    }
}