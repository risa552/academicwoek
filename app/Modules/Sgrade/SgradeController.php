<?php

namespace App\Modules\Sgrade;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;
use App\Services\CurrentUser;


class SgradeController extends Controller
{
    public function index(Request $request)
    {
        $keyword =$request->get('keyword');
        $group_id =$request->get('group_id');

        $user = CurrentUser::user();
        $sgrade = DB::table('teacher')
        ->select('teacher.*',
        'student.number',
        'student.first_name',
        'student.last_name',
        'studygroup.group_name',
        'subject.credit')
        ->leftJoin('studygroup','teacher.teach_id','studygroup.teach_id')
        ->leftJoin('student','student.group_id','studygroup.group_id')
        ->rightJoin('enrolment','student.std_id','enrolment.std_id')
        ->leftJoin('subject','subject.sub_id','enrolment.sub_id')
        ->leftJoin('educate','educate.sub_id','enrolment.sub_id')
        ->where('studygroup.teach_id',$user->teach_id)
        ->where('enrolment.status','=','ปกติ')
        ->whereNull('teacher.delete_at');

        if(!empty($keyword))
        {
            $sgrade->where(function ($query) use($keyword){
                $query->where('number','LIKE','%'.$keyword.'%')
                      ->orwhere('first_name','LIKE','%'.$keyword.'%')
                      ->orwhere('last_name','LIKE','%'.$keyword.'%');
                    //   ->orwhere('email','LIKE','%'.$keyword.'%');
            });
        }
        if(is_numeric($group_id))
        {
            $sgrade->where('student.group_id','=',$group_id);
        }

        $sgrade =  $sgrade->paginate(20);
        $studygroup = DB::table('studygroup')
        ->where('studygroup.teach_id',$user->teach_id)
        ->whereNull('delete_at')->get();
        return view('sgrade::list',compact('sgrade','studygroup'));
    }

}