<?php

namespace App\Modules\PreProgram;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class PreProgramController extends Controller
{
    public function index(Request $request)
    {
        $keyword =$request->get('keyword');
        $cou_id = $request->get('cou_id');
        $year_id = $request->get('year_id');

        $items = DB::table('program')
        ->select('program.*',
        'year.year_name',
        'course.cou_name')
        ->leftJoin('year','year.year_id','program.year_id')
        ->leftJoin('course','course.cou_id','program.cou_id')
        ->whereNull('program.deleted_at');

        if(!empty($keyword)){
            $items->where(function ($query) use($keyword){
            });
        }
        if(is_numeric($cou_id)){
            $items->where('program.cou_id','=',$cou_id);
        }
        if(is_numeric($year_id)){
            $items->where('program.year_id','=',$year_id);
        }
        $items=$items->paginate(10);
        $courses = DB::table('course')->whereNull('deleted_at')->get();
        $years = DB::table('year')->whereNull('deleted_at')->get();
        return view('preprogram::list',compact('items','years','courses'));

    }

    public function create()
    {
        $courses = DB::table('course')->whereNull('deleted_at')->get();
        $years = DB::table('year')->whereNull('deleted_at')->get();
        $groups = DB::table('studygroup')->whereNull('deleted_at')->get();
        return view('preprogram::form',compact('groups','years','courses'));
    }
    
    public function store(Request $request)
    {
        $year_id = $request->get('year_id');
        $cou_id = $request->get('cou_id');
       

        if( !empty($year_id) && !empty($cou_id) )
        {
            // $items = DB::table('program')
            // ->where('first_name',$first_name)
            // ->where('last_name',$last_name)
            // ->whereNull('student.deleted_at')->first();
            // if(!empty($items))
            // {
            //     return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้วค่ะ');
            // }   
            
            DB::table('program')->insertGetId([
                'year_id'=>$year_id,
                'cou_id'=>$cou_id,
                'created_at' =>date('Y-m-d H:i:s'),
                //'created_at' =>date('Y-m-d H::i::s'),
            ]);
            return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/preprogram');
        }else{
            return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ');
        }
    }

    public function show($program_id,Request $request)
    {
        if(is_numeric($program_id))
        {
            $items = DB::table('program')->where('program_id',$program_id)->first();
            if(!empty($items))
            {
                $courses = DB::table('course')->whereNull('deleted_at')->get();
                $years = DB::table('year')->whereNull('deleted_at')->get();   
                return view('preprogram::form',[
                    'courses'=>$courses,
                    'years'=>$years,
                    'items'=>$items
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/preprogram']);
    }

    public function update($program_id,Request $request)
    {
        if(is_numeric($program_id))
        {
            $year_id = $request->get('year_id');
            $cou_id = $request->get('cou_id');
            
            if( !empty($year_id) && !empty($cou_id) )
            {
                $items = DB::table('program')
                ->where('program_id','!=',$program_id)
                ->where('year_id',$year_id)
                ->where('cou_id',$cou_id)
                ->whereNull('deleted_at')->first();
                 if(!empty($items)){
                     return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้ว');
                }
                DB::table('program')->where('program_id',$program_id)->update([
                    'year_id'=>$year_id,
                    'cou_id'=>$cou_id,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
                
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/preprogram');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะะ');
            }
        }  
            return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }

    public function destroy($program_id)
    {
        if(is_numeric($program_id))
        {
            DB::table(['program'])->where('program_id',$program_id)->update([
                'deleted_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}
?>