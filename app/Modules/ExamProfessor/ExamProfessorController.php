<?php

namespace App\Modules\ExamProfessor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\CurrentUser;
use App\Services\MyResponse;

class ExamProfessorController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $term_id =$request->get('term_id');

        $user=CurrentUser::user();
        $now = date('Y-m-d');

        $select = 'subject.sub_code,subject.sub_name,subject.sub_name_eng,studygroup.group_name,exam.file_mid,exam.file_final,educate.educate_id';
        $exam = DB::table('educate')
                ->select(explode(',',$select))
                ->leftJoin('subject','subject.sub_id','=','educate.sub_id')
                ->leftJoin('studygroup','studygroup.group_id','=','educate.group_id')
                ->leftJoin('exam','exam.educate_id','=','educate.educate_id')
                ->where('educate.teach_id',$user->teach_id)
                ->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                            ->from('term')
                            ->where('startdate','<=',date('Y-m-d'))
                            ->where('enddate','>=',date('Y-m-d'))
                            ->whereRaw('educate.term_id = term.term_id');
                })->paginate(10);

/*
        $exam = DB::select("SELECT subject.sub_name,subject.sub_name_eng,studygroup.group_name,
        exam.file_mid,exam.file_final
        FROM educate 
        LEFT JOIN subject ON(subject.sub_id=educate.sub_id)
        LEFT JOIN studygroup ON(studygroup.group_id=educate.group_id)
        LEFT JOIN program ON(program.group_id=educate.group_id 
        AND program.term_id=educate.term_id 
        and program.sub_id=educate.sub_id)
        LEFT JOIN exam ON(exam.program_id=program.program_id)
        WHERE educate.teach_id={$user->teach_id} and program.deleted_at is null 
        AND EXISTS(SElECT 1 from term where term.term_id=educate.term_id 
        and term.startdate<='{$now}'
        and term.enddate>='{$now}')");
        */




        // table('educate')
        // ->select(
        // 'subject.sub_code',
        // 'subject.sub_name',
        // 'exam.file_mid',
        // 'exam.file_final',
        // 'subject.sub_name_eng',
        // 'studygroup.group_name')
        // ->leftJoin('subject','subject.sub_id','educate.sub_id')
        // ->leftJoin('exam','exam.program_id','program.program_id')
        // ->leftJoin('term','term.term_id','educate.term_id')
        // ->rightJoin('studygroup','studygroup.group_id','educate.group_id')

        // ->where('educate.teach_id',$user->teach_id)
        // ->whereExists(function ($query) {
        //     $query->select(DB::raw(1))
        //             ->from('term')
        //             ->where('startdate','<=',date('Y-m-d'))
        //             ->where('enddate','>=',date('Y-m-d'))
        //             ->whereRaw('program.term_id = term.term_id');
        // })
        // ->whereNull('program.deleted_at');
        
        // if(!empty($keyword)){
        //     $exam->where(function ($query) use($keyword){
        //         $query->where('term_id','LIKE','%'.$keyword.'%');
        //     });
        // }
        // if(is_numeric($term_id))
        // {
        //     $exam->where('program.term_id','=',$term_id);
        // }
        //$exam = $exam->paginate(10);
        //print_r($exam);exit;

        $rom = DB::table('term')->whereNull('deleted_at')->get();
        return view('examprofessor::form',compact('exam','rom'));
    }
}