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
    private $table3 = 'program';

    public function index(Request $request)
    {
        $keyword =$request->get('keyword');
        $std_id =$request->get('std_id');
        $program_id =$request->get('program_id');

        $items = DB::table($this->table_name)
        ->select('enrolment.*','student.std_fname','program.program_id')
        ->leftJoin('student','enrolment.std_id','student.std_id')
        ->leftJoin('program','enrolment.program_id','program.program_id')
        ->whereNull('enrolment.delete_at');

        if(!empty($keyword))
        {
            $items->where(function ($query) use($keyword){
                $query->where('status','LIKE','%'.$keyword.'%')
                      ->orwhere('year','LIKE','%'.$keyword.'%');
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
        $items = $items->orderBy('enrolment.year','asc')->paginate(10);
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
        $std_id = $request->get('std_id');
        $std_fname = $request->get('std_fname');
        $grade = $request->get('grade');
        $status = $request->get('status');
        $year = $request->get('year');
        $program_id = $request->get('program_id');
        if( !empty($std_id) && !empty($std_fname) && !empty($grade) && !empty($status) && !empty($year) && !empty($program_id))
        {
            $items = DB::table($this->table_name)
            ->where('program_id',$program_id)
            ->whereNull('delete_at')->first();
            if(!empty($items))
            {
                return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้ว');
            }   
            DB::table($this->table_name)->insert([
                
                'std_id'=>$std_id,
                'std_fname'=>$std_fname,
                'grade'=>$grade,
                'status'=>$status,
                'year'=>$year,
                'program_id'=>$program_id,
                'created_at' =>date('Y-m-d H:i:s'),
                //'created_at' =>date('Y-m-d H::i::s'),
            ]);
            return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/enrolment');
        }else{
            return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ');
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
                    'program'=>$program
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/enrolment']);
    }

    public function update($enro_id,Request $request)
    {
        if(is_numeric($enro_id))
        {
            $std_id = $request->get('std_id');
            $std_fname = $request->get('std_fname');
            $grade = $request->get('grade');
            $status = $request->get('status');
            $year = $request->get('year');
            $program_id = $request->get('program_id');
            
            if( !empty($std_id) && !empty($std_fname) && !empty($grade) && !empty($status) && !empty($year) && !empty($program_id))    
            {
                $items = DB::table($this->table_name)
            ->where('enro_id','!=',$enro_id)
            ->where('program_id',$program_id)
            ->whereNull('delete_at')->first();
            if(!empty($items)){
                return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้ว');
            }
                DB::table($this->table_name)->where('enro_id',$enro_id)->update([
                   
                    'std_id'=>$std_id,
                    'std_fname'=>$std_fname,
                    'grade'=>$grade,
                    'status'=>$status,
                    'year'=>$year,
                    'program_id'=>$program_id,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/enrolment');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะะ');
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