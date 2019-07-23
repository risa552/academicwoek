<?php

namespace App\Modules\Degree;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class DegreeController extends Controller
{
    public function index(Request $request)
    {
        /*DB::table('degree')->insert([
            'degree_name' => 'ป.ตรี',
        ]);  */
        $keyword =$request->get('keyword');
        
        $degree = DB::table('degree')
        ->whereNull('delete_at');
        if(!empty($keyword)){
            $degree->where(function ($query) use($keyword){
                $query->where('degree_name','LIKE','%'.$keyword.'%');
            });
        }
        $degree = $degree->paginate(10);
        return view('degree::degree',[
            'degree'=>$degree
        ]);
    }

    public function create()
    {
        return view('degree::fromdegree');
    
    }

    public function store(Request $request)
    {
        
        {
            $degree_name = $request->get('degree_name');
            
            if(!empty($degree_name) )
            {

                DB::table('degree')->insert([
                    'degree_name' =>$degree_name,
                    'created_at' =>date('Y-m-d H:i:s'),
                ]);
               // print_r('degree');exit;
               return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/degree');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ'); 
            }
        }
    }

    public function show($degree_id,Request $request)
    {
        if(is_numeric($degree_id))
        {
            $degree = DB::table('degree')->where('degree_id',$degree_id)->first();
            if(!empty($degree))
            {
                return view('degree::fromdegree',[
                    'degree'=>$degree
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/degree']);
    }
    public function update($degree_id,Request $request)
    {
        if(is_numeric($degree_id))
        {
            
            $degree_name = $request->get('degree_name');

            if(!empty($degree_name) )
            {
               
                DB::table('degree')->where('degree_id',$degree_id)->update([
                    'degree_name' =>$degree_name,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/degree');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ');
            }
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
    
    public function destroy($degree_id)
    {
        if(is_numeric($degree_id))
        {
            DB::table('degree')->where('degree_id',$degree_id)->update([
                'delete_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}
