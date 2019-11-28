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
                
        $terms = DB::table('term')
        ->whereExists(function ($query) use($user) {
            $query->select(DB::raw(1))
                  ->from('enrolment')
                  ->where('std_id',$user->std_id)
                  ->whereRaw('enrolment.term_id = term.term_id');
        })
        ->orderBy('term.term_name')
        ->get();

        $sumary =[];
        foreach($terms as $term){
            $sumary[$term->term_id] = [
                'have_term' =>0,//หน่วยกิตที่ได้ต่อเทอม
                'count_term' =>0,//หน่วยกิตรวมต่อเทอม
                'score_term' =>0,//หน่วยกิต*เกรด ทุกวิชา แล้วเอาผลมาบวกกัน
                'GPA_term' =>0,//เอา score / count
                'have_glean' =>0,//หน่วยกิตที่ได้สะสมทั้งหมด
                'count_glean' =>0,//หน่วยกิตรวมสะสมทั้งหมด
                'score_glean' =>0,//หน่วยกิต*เกรด ทุกวิชา แล้วเอาผลมาบวกกันสะสมทั้งหมด
                'GPA_glean' =>0,//เอา score / countสะสมทั้งหมด
                'total_grade' =>0,//เอา score / countสะสมทั้งหมด
            ];
        }

        $grades = DB::table('enrolment')
        ->select('enrolment.*',
        'subject.sub_code',
        'subject.sub_name',
        'subject.sub_name_eng',
        'subject.credit',
        'subject.theory',
        'subject.practice',
        'subject.special',
        'term.term_name',
        'term.term_year')
        ->leftJoin('subject','subject.sub_id','enrolment.sub_id')
        ->leftJoin('term','term.term_id','enrolment.term_id')
        ->where('enrolment.std_id',$user->std_id)->get();
        // print_r($grades);exit;

        $mapping_grade =[
            'A'=>4,
            'B+'=>3.5,
            'B'=>3,
            'C+'=>2.5,
            'C'=>2,
            'D+'=>1.5,
            'D'=>1,
            'F'=>0,
            'S'=>50,
            'U'=>0,
        ];
        $grade_byterm = [];
        foreach($grades as $grade)
        {
            $grade_byterm[$grade->term_id][] = $grade;
            $sumary[$grade->term_id]['count_term'] += $grade->credit;
            if($grade->grade != 'F' && $grade->grade != 'U' && $grade->grade != 'S')
            $sumary[$grade->term_id]['have_term'] += $grade->credit;
            if(!empty($grade->grade) && $grade->grade != 'U' && $grade->grade != 'S')
            $sumary[$grade->term_id]['score_term'] += ($grade->credit*$mapping_grade[$grade->grade]);
        }
        foreach($terms as $term){
            
            $sumary[$term->term_id]['GPA_term'] = $sumary[$term->term_id]['score_term']/$sumary[$term->term_id]['count_term'];
        }
        foreach($terms as $index=> $term){
            for($i=0;$i<$index+1;$i++){
                $sumary[$term->term_id]['have_glean'] += $sumary[$terms[$i]->term_id]['have_term'];
                $sumary[$term->term_id]['count_glean'] += $sumary[$terms[$i]->term_id]['count_term'];
                $sumary[$term->term_id]['score_glean'] += $sumary[$terms[$i]->term_id]['score_term'];
            }
            
        }
        foreach($terms as $term){
            
            $sumary[$term->term_id]['GPA_glean'] = $sumary[$term->term_id]['score_glean']/$sumary[$term->term_id]['count_glean'];
        }
        // print_r($terms);exit;
        
        return view ('hisgrade::list',compact('history','grade_byterm','mapping_grade','terms','sumary'));
    }

    
}
?>