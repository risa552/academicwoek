<?php

namespace App\Modules\Plan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;
use App\Services\CurrentUser;


class PlanController extends Controller
{
    public function show($std_id,Request $request)
    {
        $sub_id =$request->get('sub_id');

        $items = DB::table('enrolment')
        ->select('enrolment.*',
        'subject.sub_code',
        'subject.sub_name',
        'subject.sub_nameeng',
        'term.term_name',
        'term.year')
        ->rightJoin('subject','enrolment.sub_id','subject.sub_id')
        ->rightJoin('term','enrolment.term_id','term.term_id')
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('term')
                  ->where('startdate','<=',date('Y-m-d'))
                  ->where('enddate','>=',date('Y-m-d'))
                  ->whereRaw('enrolment.term_id = term.term_id');
        })
        ->whereNull('enrolment.delete_at')
        ->whereNull('term.delete_at')
        ->where('enrolment.std_id','=',$std_id)->get();

        $student  = DB::table('student')
        ->select('student.number','student.first_name','student.last_name')
        ->where('std_id',$std_id)->first();
        

        
        $subject = DB::table('subject')->whereNull('delete_at')->get();
           // print_r($student);exit;
        return view('plan::list',compact('items','student','subject'));
    }

    
    public function update($enro_id,Request $request)
    {
        if(is_numeric($enro_id))
        {
            $sub_id= $request->get('sub_id');
            $status= $request->get('status');
            if( !empty($sub_id) && !empty($status))
            {
                DB::table('enrolmemt')->where('enro_id',$enro_id)->update([
                    'sub_id' =>$sub_id,
                    'status' =>$status,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/plan');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยคะ');
            }
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }

    public function create()
    {
        $subject = DB::table('subject')->whereNull('delete_at')->get();       
        return view('plan::form',compact('subject'));
    }
    
    public function store($std_id,Request $request)
    {
        $sub_id = $request->get('sub_id');
        $status = $request->get('status');
        if(!empty($sub_id) && !empty($status)){
            DB::table('enrolment')->insertGetId([
                'sub_id' => $sub_id,
                'status' => $status,
                'created_at' =>date('Y-m-d H:i:s')
            ]);
            return MyResponse::success('ระบบได้บันทึกข้องมูลเรียนร้อยแล้ว','/plan');
        }else{
            return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยคะ');
        }
    }

    public function dastroy($std_id)
    {
        DB::table('enrolment')->where('std_id',$std_id)->update([
            'delete_at' =>date('Y-m-d H:i:s'),
        ]);
        return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
    }
   
}