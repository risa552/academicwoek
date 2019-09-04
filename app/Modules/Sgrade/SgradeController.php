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
    public function index()
    {
        $user = CurrentUser::user();
        $sgrade = DB::table('studygroup')
        ->select('studygroup.*',
        // 'teacher.first_name',
        // 'teacher.last_name',
        'student.first_name',
        'student.last_name',
        'enrolment.score',
        'enrolment.grade',
        'subject.sub_code',
        'subject.sub_name',
        'enrolment.status')
        // ->leftJoin('teacher','teacher.teach_id','studygroup.teach_id')
        ->leftJoin('student','student.group_id','studygroup.group_id')
        ->leftJoin('enrolment','enrolment.std_id','student.std_id')
        ->leftJoin('subject','enrolment.sub_id','subject.sub_id')
        ->where('studygroup.teach_id',$user->teach_id)
        ->where('enrolment.status','=','ปกติ')
        ->get();

        return view('sgrade::list',compact('sgrade'));
    }

}