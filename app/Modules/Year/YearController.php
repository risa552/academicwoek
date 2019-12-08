<?php

namespace App\Modules\Year;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class YearController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');

        $years = DB::table('year')->whereNull('deleted_at');
        
        if(!empty($keyword))
        {
            $years->where(function ($query) use($keyword){
                $query->where('year_name','LIKE','%'.$keyword.'%');
            });
        }
        $years = $years->get();

        return view ('year::list',compact('years'));
    }

    public function create()
    {
        return view('year::form');
    }

    public function store(Request $request)
    {
        $year_name = $request->get('year_name');
        
        if(!empty($year_name) )
        {
            $years = DB::table('year')
            ->where('year_name',$year_name)
            ->whereNull('deleted_at')->first();
            if(!empty($years)){
                return MyResponse::error('ขออภัยข้อมูลระดับนี้มีอยู่ในระบบแล้ว');
            }
            DB::table('year')->insert([
                'year_name' =>$year_name,
                'created_at' =>date('Y-m-d H:i:s'),
            ]);
            // print_r('degree');exit;
            return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/year');
        }else{
            return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ'); 
        }
    }

    public function show($year_id,Request $request)
    {
        if(is_numeric($year_id))
        {
            $years = DB::table('year')->where('year_id',$year_id)->first();
            if(!empty($years))
            {
                return view('year::form',[
                    'years'=>$years
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/year']);
    }
    public function update($year_id,Request $request)
    {
        if(is_numeric($year_id))
        {
            
            $year_name = $request->get('year_name');

            if(!empty($year_name) )
            {
                $years = DB::table('year')
                ->where('year_id','!=',$year_id)
                ->where('year_name',$year_name)
                ->whereNull('deleted_at')->first();
                if(!empty($years)){
                    return MyResponse::error('ขออภัยข้อมูลระดับนี้มีอยู่ในระบบแล้ว');
                }
                DB::table('year')->where('year_id',$year_id)->update([
                    'year_name' =>$year_name,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/year');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ');
            }
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
    
    public function destroy($year_id)
    {
        if(is_numeric($year_id))
        {   
            // $exists = DB::table('studygroup')
            // ->where('degree_id',$degree_id)
            // ->whereNull('deleted_at')->first();
            // if(!empty($exists))
            // {
            //     return MyResponse::error('ขออภัยไม่สามารถลบรายการนีได้');
            // }   
            DB::table('year')->where('year_id',$year_id)->update([
                'deleted_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}