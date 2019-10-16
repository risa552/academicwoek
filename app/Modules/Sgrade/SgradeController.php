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
        'studygroup.group_name',
        'studygroup.group_id')
        ->leftJoin('studygroup','teacher.teach_id','studygroup.teach_id')
        ->where('studygroup.teach_id',$user->teach_id)
        ->whereNull('teacher.delete_at');

        
        if(is_numeric($group_id))
        {
            $sgrade->where('studygroup.group_id','=',$group_id);
        }

        $sgrade =  $sgrade->paginate(20);
        $studygroup = DB::table('studygroup')
        ->where('studygroup.teach_id',$user->teach_id)
        ->whereNull('delete_at')->get();
        return view('sgrade::list',compact('sgrade','studygroup'));
    }
    public function show($group_id,Request $request)
    {
        $students = DB::table('studygroup')
        ->select('studygroup.*',
        'student.std_id',
        'student.number',
        'student.first_name',
        'student.last_name')
        ->leftJoin('student','student.group_id','studygroup.group_id')
        // ->whereRaw(DB::raw('studygroup.group_id = student.group_id'))
        ->where('studygroup.group_id',$group_id)
        ->whereNull('studygroup.delete_at')
        ->get();

        $result_greads = DB::select("SELECT CASE grade
        when 'A' Then 4
        when 'B+' Then 3.5
        when 'B' Then 3
        when 'C+' Then 2.5
        when 'C' Then 2
        when 'D+' Then 1.5
        when 'D' Then 1
        when 'F' then 0
        when null then 0
        END as total,
        std_id,credit FROM `enrolment` LEFT JOIN subject ON(enrolment.sub_id=subject.sub_id)
        WHERE ( grade NOT IN('S','U') OR grade is null)  ");

        $temp = [];
        if(!empty($result_greads))
        {
            foreach($result_greads as $g)
            {
                if(!isset($temp[$g->std_id]))
                {
                    $temp[$g->std_id] = [
                        'score'=>$g->total*$g->credit,
                        'credit'=>$g->credit,
                    ];
                }
                else
                {
                    $temp[$g->std_id]['score']+=($g->total*$g->credit);
                    $temp[$g->std_id]['credit']+=$g->credit;
                } 
            }
        }
        // print_r($result_greads);exit;

        $student_gpa = [];
        foreach($temp as $std_id=>$item)
        {
            $student_gpa[$std_id] = number_format($item['score']/$item['credit'],2);
        }
        // print_r($student_gpa[$std_id]);exit;
        $group = DB::table('studygroup')
        ->where('studygroup.group_id',$group_id)
        ->whereNull('delete_at')->first();


        return view('sgrade::form',compact('students','group','student_gpa'));
    }
}