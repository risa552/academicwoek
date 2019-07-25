<?php

namespace App\Modules\Enrolment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class EnrolmentController extends Controller
{
    private $table_name = 'enrolment';
    private $table2 = 'student';
    private $table3 = 'educationprogram';

    public function index(Request $request)
    {
        $keyword =$request->get('keyword');
        $std_id =$request->get('std_id');
        $program_id =$request->get('program_id');

        $items = DB::table($this->table_name)
        ->select('enrolment.*','student.std_fname','educationprogram.program_name')
        ->leftJoin('student','enrolment.std_id','student.std_id')
        ->leftJoin('educationprogram','enrolment.program_id','educationprogram.program_id')
        ->whereNull('enrolment.delete_at');

        if(!empty($keyword))
        {
            $items->where(function ($query) use($keyword){
                $query->where('date','LIKE','%'.$keyword.'%')
                      ->orwhere('status','LIKE','%'.$keyword.'%');
            });
        }
        if(is_numeric($std_id))
        {
            $items->where('enrolment.std_id','=',$std_id);
        }
        if(is_numeric($program_id))
        {
            $items->where('enrolment.program_id','=',$program_id);
        }
        $items = $items->orderBy('enrolment.date','asc')->paginate(10);
        $student = DB::table($this->table2)->whereNull('delete_at')->get();
        $program = DB::table($this->table3)->whereNull('delete_at')->get();
        return view($this->table_name.'::list',compact('items','student','program'));
    }
    
    public function create()
    {
        $student = DB::table($this->table2)->whereNull('delete_at')->get();
        $program = DB::table($this->table3)->whereNull('delete_at')->get();
        return view($this->table_name.'::form',compact('student','program'));
    }
    
    public function store(Request $request)
    {
        $date = $request->get('date');
        $status = $request->get('status');
        $grade = $request->get('grade');
        $std_id = $request->get('std_id');
        $program_id = $request->get('program_id');
        
        if( !empty($date) && !empty($status) && !empty($grade) && !empty($std_id)&& !empty($program_id))
        {
            $items = DB::table($this->table_name)
            ->where('status',$status)
            ->where('status',$status)
            ->where('grade',$grade)
            ->whereNull('delete_at')->first();
            if(!empty($items))
            {
                return MyResponse::error('ขออภัยข้อมูลกลุ่มเรียนนี้มีอยู่ในระบบแล้ว');
            }   
            DB::table($this->table_name)->insert([
                'date' =>$date,
                'status' =>$bran_id,
                'grade'=>$grade,
                'std_id'=>$std_id,
                'program_id'=>$program_id,
                'created_at' =>date('Y-m-d H:i:s'),
                //'created_at' =>date('Y-m-d H::i::s'),
            ]);
            return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/enrolment');
        }else{
            return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยคะ');
        }
    }

    public function show($enro_id,Request $request)
    {
        if(is_numeric($enro_id))
        {
            $items = DB::table($this->table_name)->where('enro_id',$enro_id)->first();
            if(!empty($items))
            {
                $student = DB::table($this->table2)->whereNull('delete_at')->get();
                $program = DB::table($this->table3)->whereNull('delete_at')->get();
                return view($this->table_name.'::form',[
                    'items'=>$items,
                    'student'=>$student,
                    'program'=>$program,
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/enrolment']);
    }

    public function update($enro_id,Request $request)
    {
        if(is_numeric($enro_id))
        {
            $date = $request->get('date');
            $status = $request->get('status');
            $grade = $request->get('grade');
            $std_id = $request->get('std_id');
            $program_id = $request->get('program_id');
            
            if( !empty($date) && !empty($status) && !empty($grade) && !empty($std_id)&& !empty($program_id))
            {
                $items = DB::table($this->table_name)
            ->where('enro_id','!=',$enro_id)
            ->where('status',$status)
            ->where('grade',$grade)
            ->whereNull('delete_at')->first();
            if(!empty($items)){
                return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้ว');
            }
                DB::table($this->table_name)->where('enro_id',$enro_id)->update([
                    'date' =>$date,
                    'status' =>$status,
                    'grade'=>$grade,
                    'std_id'=>$std_id,
                    'program_id'=>$program_id,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/enrolment');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยคะ');
            }
        }  
            return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }

    public function destroy($enro_id)
    {
        if(is_numeric($enro_id))
        {
            DB::table($this->table_name)->where('enro_id',$enro_id)->update([
                'delete_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}