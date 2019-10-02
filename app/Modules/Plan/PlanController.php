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
    public function create(Request $request)
    {
        $std_id = $request->get('std_id');

        $subject = DB::table('subject')->whereNull('delete_at')->get();
        $term = DB::table('term')->whereNull('delete_at')->get();       
        return view('plan::form',compact('subject','term','std_id'));
    }
    
    public function store(Request $request)
    {
        $std_id = $request->get('std_id');
        $sub_id = $request->get('sub_id');
        $term_id = $request->get('term_id');
        $status = $request->get('status');
        if(!empty($sub_id) && !empty($term_id) && !empty($status)){
            DB::table('enrolment')->insertGetId([
                'std_id' =>$std_id,
                'sub_id' =>$sub_id,
                'term_id' =>$term_id,
                'status' =>$status,
                'created_at' =>date('Y-m-d H:i:s')
            ]);
            return MyResponse::success('ระบบได้บันทึกข้องมูลเรียนร้อยแล้ว','/plan/'.$std_id);
        }else{
            return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยคะ');
        }
    }


    public function show($std_id,Request $request)
    {
        $sub_id =$request->get('sub_id');

        $items = DB::table('enrolment')
        ->select('enrolment.*',
        'subject.sub_code',
        'subject.sub_name',
        'subject.sub_nameeng',
        'term.term_name',
        'term.term_year')
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
        ->select('student.number','student.first_name','student.last_name','std_id')
        ->where('std_id',$std_id)->first();
        

        
        $subject = DB::table('subject')->whereNull('delete_at')->get();
           // print_r($student);exit;
        return view('plan::list',compact('items','student','subject','std_id'));
    }

    public function editplan($enro_id,Request $request)
    {
        if(is_numeric($enro_id))
        {
            $item = DB::table('enrolment')->where('enro_id',$enro_id)->first();
            if(!empty($item)){
               
                $subject = DB::table('subject')->whereNull('delete_at')->get();
                $term = DB::table('term')->whereNull('delete_at')->get(); 
                return view('plan::form',[
                    'item'=>$item,
                    'std_id'=>$item->std_id,
                    'subject'=>$subject,
                    'term'=>$term
                ]);
            }
        }
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

    
    public function dastroy($enro_id)
    {
        DB::table('enrolment')->where('enro_id',$enro_id)->update([
            'delete_at' =>date('Y-m-d H:i:s'),
        ]);
        return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
    }
   
}