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
    public function index()
    {
       
        $user=CurrentUser::user();
        $exam = DB::table('program')
        ->select('program.program_id',
        'subject.sub_code',
        'subject.sub_name',
        'teacher.first_name',
        'teacher.last_name',
        'exam.file',
        'exam.created_at')
        ->leftJoin('subject','program.sub_id','subject.sub_id')
        ->leftJoin('exam','program.program_id','exam.program_id')
        ->leftJoin('teacher','program.teach_id','teacher.teach_id')
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('term')
                  ->where('startdate','<=',date('Y-m-d'))
                  ->where('enddate','>=',date('Y-m-d'))
                  ->whereRaw('program.term_id = term.term_id');
        })
        ->where('program.teach_id',$user->teach_id)
        ->whereNull('program.delete_at')->get();
          //  print_r($exam);exit;
        return view('examprofessor::form',compact('exam'));
    }
}