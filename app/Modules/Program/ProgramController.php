<?php

namespace App\Modules\Program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        $keyword =$request->get('keyword');
        
        $educationprogram = DB::table('educationprogram')
        ->whereNull('delete_at');
        if(!empty($keyword)){
            $educationprogram->where(function ($query) use($keyword){
                $query->where('program_name','LIKE','%'.$keyword.'%');
            });
        }
        $educationprogram = $educationprogram->paginate(10);
        return view('program::program',[
            'educationprogram'=>$educationprogram
        ]);
    }

    public function create()
    {
        return view('program::fromprogrom');
    
    }

    public function store(Request $request)
    {
        
        {
            $program_name = $request->get('program_name');
            $cou_id = $request->get('cou_id');

            if(!empty($program_name) && !empty($cou_id) )
            {
               
                DB::table('educationprogram')->insert([
                    'program_name' =>$program_name,
                    'cou_id' =>$cou_id,
                    'created_at' =>date('Y-m-d H:i:s'),
                ]);
               return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/program');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ'); 
            }
        }   
    }

    public function show($program_id,Request $request)
    {
        if(is_numeric($program_id))
        {
            $educationprogram = DB::table('educationprogram')->where('program_id',$program_id)->first();
            if(!empty($educationprogram))
            {
                return view('program::fromprogrom',[
                    'educationprogram'=>$educationprogram
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/professor']);
    }
    public function update($program_id,Request $request)
    {
        if(is_numeric($program_id))
        {
            $program_name = $request->get('program_name');
            $cou_id = $request->get('cou_id');

            if(!empty($program_name) && !empty($cou_id) )
            {
               
                DB::table('educationprogram')->where('program_id',$program_id)->update([
                    'program_name' =>$program_name,
                    'cou_id' =>$cou_id,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/program');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ');
            }
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
    
    public function destroy($program_id)
    {
        if(is_numeric($program_id))
        {
            DB::table('educationprogram')->where('program_id',$program_id)->update([
                'delete_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}