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
        
        $user=CurrentUser::user();
        $items = DB::table('educate')
        ->select('educate.*',
        'subject.sub_name',
        'subject.sub_name_eng',
        'studygroup.group_name',
        'term.term_name',
        'term.term_year')
        ->leftJoin('subject','subject.sub_id','educate.sub_id')
        ->leftJoin('studygroup','studygroup.group_id','educate.group_id')
        ->leftJoin('term','term.term_id','educate.term_id')
        ->where('educate.teach_id',$user->teach_id)

        ->whereRaw(DB::raw('studygroup.group_id = educate.group_id'))
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                    ->from('term')
                    ->where('startdate','<=',date('Y-m-d'))
                    ->where('enddate','>=',date('Y-m-d'))
                    ->whereRaw('educate.term_id = term.term_id');
        })
        ->whereNull('educate.delete_at');

        $items =$items->paginate(10);
        return view ('ggrade::list',compact('items'));

    }
    public function show($educate_id,Request $request)
    {
        $keyword = $request->get('keyword');

        $user=CurrentUser::user();
        $ggrade = DB::table('enrolment')
        ->select('enrolment.grade',
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
        if(!empty($keyword)){
            $ggrade->where(function ($query) use($keyword){
                $query->where('student.first_name','LIKE','%'.$keyword.'%')
                        ->orwhere('student.last_name','LIKE','%'.$keyword.'%');
            });
        }

        $subject = DB::table('subject')
        ->select('subject.*',
        'studygroup.group_name')
        ->leftJoin('educate','educate.sub_id','subject.sub_id')
        ->leftJoin('studygroup','educate.group_id','studygroup.group_id')
        ->whereNull('subject.delete_at')->first();

        
        $ggrade = $ggrade->OrderBy('subject.sub_name','asc')->OrderBy('studygroup.group_name','asc')->get();
        $rom = DB::table('term')->whereNull('delete_at')->get();
        $rom1 = DB::table('subject')
        ->leftJoin('educate','educate.sub_id','subject.sub_id')
        ->where('educate.teach_id',$user->teach_id)
        ->whereNull('subject.delete_at')
        ->get();
        $rom2 = DB::table('studygroup')->whereNull('delete_at')->get();
        return view('ggrade::form',compact('ggrade','rom','rom1','rom2','subject','educate_id'));
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