<?php

namespace App\Modules\Exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class ExamController extends Controller
{
    private $table_name = 'subject';

    public function index(Request $request)
    {
        $keyword =$request->get('keyword');
        $sub_id = $request->get('sub_id');
        $teach_id = $request->get('teach_id');

        $exam = DB::table('educate')
        ->select('educate.*',
        'subject.sub_code',
        'subject.sub_name',
        'subject.sub_name_eng',
        
        'sendexam.file_mid',
        'sendexam.file_final',
        'teacher.first_name',
        'teacher.last_name',
        'term.term_name',
        'term.term_year')
        ->leftJoin('subject','educate.sub_id','subject.sub_id')
        ->leftJoin('term','educate.term_id','term.term_id')
        ->leftJoin('teacher','educate.teach_id','teacher.teach_id')
        ->leftJoin('sendexam','sendexam.term_id','term.term_id')

        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('term')
                  ->where('startdate','<=',date('Y-m-d'))
                  ->where('enddate','>=',date('Y-m-d'))
                  ->whereRaw('educate.term_id = term.term_id');
        })
        ->whereNull('educate.deleted_at');
        if(!empty($keyword)){
            $exam->where(function ($query) use($keyword){
                $query->where('sub_name','LIKE','%'.$keyword.'%');
            });
        }
        if(is_numeric($sub_id)){
            $exam->where('educate.sub_id','=',$sub_id);
        }
        if(is_numeric($teach_id)){
            $exam->where('educate.teach_id','=',$teach_id);
        }
        $exam = $exam->get();
        $items = DB::table($this->table_name)->whereNull('deleted_at')->get();       
        $teachs = DB::table('teacher')->whereNull('deleted_at')->get();       
        return view('exam::exam',compact('exam','items','teachs'));
    }
    
    public function create()
    {
        $items = DB::table($this->table_name)->whereNull('deleted_at')->get();
        return view('exam::fromexam',compact('items'));
    }
    
    public function store(Request $request)
    {
        $sub_id = $request->get('sub_id');
        $sub_code = $request->get('sub_code');
        $sub_name = $request->get('sub_name');
        
        
        if(!empty($sub_id) && !empty($sub_code) && !empty($sub_name) )
        {
            DB::table('exam')->insert([
                'sub_id'=>$sub_id,
                'sub_code'=>$sub_code,
                'sub_name'=>$sub_name,
                'created_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/exam');
        }else{
            return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยคะ');
        }
    }

    public function show($exam_id,Request $request)
    {
        if(is_numeric($exam_id))
        {
            $exam = DB::table('exam')->where('exam_id',$exam_id)->first();
            if(!empty($exam))
            {
                return view('exam::fromexam',[
                    'exam'=>$exam
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/exam']);
    }

    public function update($exam_id,Request $request)
    {
        if(is_numeric($exam_id))
        {
            $exam_id = $request->get('exam_id');
            if( !empty($exam_id))
            {
                DB::table('exam')->where('exam_id',$exam_id)->update([
                    'exam_name' =>$exam_name,
                    'date' =>date('Y-m-d H:i:s'),
                    'sub_id'=>$sub_id,
                ]);
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/exam');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยคะ');
            }
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
    public function destroy($exam_id)
    {
        if(is_numeric($exam_id))
        {
            DB::table('exam')->where('exam_id',$exam_id)->update([
                'deleted_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}