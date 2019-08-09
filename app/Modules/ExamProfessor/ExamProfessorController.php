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
        $exam = DB::table('program')
        ->select('program.program_id',
        'program.term_id',
        'subject.sub_code',
        'subject.sub_name',
        'educate.educate_id',
        'teacher.first_name',
        'teacher.last_name',
        'exam.file',
        'exam.created_at')
        ->leftJoin('subject','program.sub_id','subject.sub_id')
        ->leftJoin('exam','program.program_id','exam.program_id')
        ->leftJoin('educate','educate.educate_id','educate.sub_id','educate.teach_id')
        ->leftJoin('teacher','teacher.teach_id','educate.teach_id')
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('term')
                  ->where('startdate','<=',date('Y-m-d'))
                  ->where('enddate','>=',date('Y-m-d'))
                  ->whereRaw('program.term_id = term.term_id');
        })
        ->where('educate.teach_id',$user->teach_id)
        ->whereNull('program.delete_at');

        if(!empty($keyword)){
            $exam->where(function ($query) use($keyword){
                $query->where('term_id','LIKE','%'.$keyword.'%');
            });
        }
        if(is_numeric($term_id))
        {
            $exam->where('program.term_id','=',$term_id);
        }
          //  print_r($exam);exit;
        $exam = $exam->get();
        $rom = DB::table('term')->whereNull('delete_at')->get();
        return view('examprofessor::form',compact('exam','rom'));
    }
}