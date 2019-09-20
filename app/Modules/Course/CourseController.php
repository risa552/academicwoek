<?php

namespace App\Modules\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        /*DB::table('course')->insert([
            'cou_name' => 'บัณฑิต',
        ]);  */
        $keyword =$request->get('keyword');
        
        $course = DB::table('course')
        ->whereNull('delete_at');
        if(!empty($keyword)){
            $course->where(function ($query) use($keyword){
                $query->where('cou_name','LIKE','%'.$keyword.'%')
                      ->orwhere('cou_year','LIKE','%'.$keyword.'%');
            });
        }
        $course = $course->paginate(10);
        return view('course::course',[
            'course'=>$course,
        ]);
    }

    public function create()
    {
        return view('course::fromcourse');
    
    }

    public function store(Request $request)
    {
        
        {
            $cou_name = $request->get('cou_name');
            $cou_year = $request->get('cou_year');

            if(!empty($cou_name)&& !empty($cou_year) )
            {
                
                DB::table('course')->insert([
                    'cou_name' =>$cou_name,
                    'cou_year' =>$cou_year,
                    'created_at' =>date('Y-m-d H:i:s'),
                ]);
               // print_r('course');exit;
               return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/course');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ'); 
            }
        }
    }

    public function show($cou_id,Request $request)
    {
        if(is_numeric($cou_id))
        {
            $course = DB::table('course')->where('cou_id',$cou_id)->first();
            if(!empty($course))
            {
                return view('course::fromcourse',[
                    'course'=>$course
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/course']);
    }
    public function update($cou_id,Request $request)
    {
        if(is_numeric($cou_id))
        {
            
            $cou_name = $request->get('cou_name');
            $cou_year = $request->get('cou_year');

            if(!empty($cou_name) && !empty($cou_year) )
            {
               
                DB::table('course')->where('cou_id',$cou_id)->update([
                    'cou_name' =>$cou_name,
                    'cou_year' =>$cou_year,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/course');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ');
            }
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
    
    public function destroy($cou_id)
    {
        if(is_numeric($cou_id))
        {
            $exists = DB::table('branch')
            ->where('cou_id',$cou_id)
            ->whereNull('delete_at')->first();
            if(!empty($exists))
            {
                return MyResponse::error('ขออภัยไม่สามารถลบรายการนีได้');
            }   
            DB::table('course')->where('cou_id',$cou_id)->update([
                'delete_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}
