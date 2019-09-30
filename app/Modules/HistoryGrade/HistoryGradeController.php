<?php

namespace App\Modules\HistoryGrade;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;
use App\Services\CurrentUser;

class HistoryGradeController extends Controller
{
    public function index()
    {
        
        
        $user=CurrentUser::user();
        $history = DB::table('student')
        ->select('student.first_name',
        'student.last_name',
        'student.number',
        'course.cou_name',
        'branch.bran_name',
        'studygroup.group_name',
        'degree.degree_name')
        ->leftJoin('studygroup','student.group_id','studygroup.group_id')
        ->rightJoin('branch','studygroup.bran_id','branch.bran_id')
        ->rightJoin('degree','studygroup.degree_id','degree.degree_id')
        ->rightJoin('course','branch.cou_id','course.cou_id')
        ->where('student.std_id',$user->std_id)
        ->whereNull('studygroup.delete_at')
        ->whereNull('branch.delete_at')
        ->whereNull('degree.delete_at')
        ->whereNull('course.delete_at')
        ->whereNull('student.delete_at')->get();
        //print_r($history);exit;
        
        $grades = DB::table('enrolment')
        ->select('enrolment.*',
        'subject.sub_code',
        'subject.sub_name',
        'subject.credit',
        'subject.theory',
        'subject.practice',
        'term.term_name',
        'term.term_year')
        ->leftJoin('subject','subject.sub_id','enrolment.sub_id')
        ->leftJoin('term','term.term_id','enrolment.term_id')
        ->where('enrolment.std_id',$user->std_id)->get();
        //ต่อเทอม
        $down_term = 0;//หน่วยกิตรวมต่อเทอม
        $have_term = 0;//หน่วยกิตที่ได้ต่อเทอม
        $count_term = 0;//หน่วยกิตรวมต่อเทอม
        $score_term = 0;//หน่วยกิต*เกรด ทุกวิชา แล้วเอาผลมาบวกกัน
        $GPA_term = 0;//เอา score / count
        //สะสม
        $down_glean = 0;
        $have_glean = 0;
        $count_glean = 0;
        $score_glean = 0;
        $GPA_glean = 0;

        $mapping_grade =[
            'A'=>4,
            'B+'=>3.5,
            'B'=>3,
            'C+'=>2.5,
            'C'=>2,
            'D+'=>1.5,
            'D'=>1,
            'F'=>0,
        ];
        // foreach($grades as $grade)
        // {
        //     if()
        // }


        return view ('hisgrade::list',compact('history','grades','mapping_grade'));
    }

    
}
?>