<?php

namespace App\Modules\Exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class ExamController extends Controller
{
    public function index(Request $request)
    {
        $keyword =$request->get('keyword');
        $exam = DB::table('exam')
        ->whereNull('delete_at');
        if(!empty($keyword)){
            $exam->where(function ($query) use($keyword){
                $query->where('exam_name','LIKE','%'.$keyword.'%')
                      ->orwhere('dat','LIKE','%'.$keyword.'%');
            });
        }
        $exam = $exam->paginate(10);
        return view('exam::exam',[
            'exam'=>$exam
        ]);
    }
    
    public function create()
    {
        return view('exam::fromexam');
    }
    
    public function store(Request $request)
    {
        $exam_name = $request->get('exam_name');
        $sub_id = $request->get('sub_id');
        
        if( !empty($exam_name) &&  !empty($sub_id))
        {
            DB::table('exam')->insert([
                'exam_name' =>$exam_name,
                'date' =>date('Y-m-d H:i:s'),
                'sub_id'=>$sub_id,
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
                'delete_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}