<?php

namespace App\Modules\Branch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        $keyword =$request->get('keyword');
        
        $branch = DB::table('branch')
        ->whereNull('delete_at');
        if(!empty($keyword)){
            $branch->where(function ($query) use($keyword){
                $query->where('bran_name','LIKE','%'.$keyword.'%');
            });
        }
        $branch = $branch->paginate(10);
        return view('branch::branch',[
            'branch'=>$branch
        ]);
    }

    public function create()
    {
        return view('branch::frombranch');
    
    }

    public function store(Request $request)
    {
        
        {
            $bran_name = $request->get('bran_name');
            $con_id = $request->get('con_id');

            if(!empty($bran_name) && !empty($con_id))
            {
               
                DB::table('Branch')->insert([
                    'bran_name' =>$bran_name,
                    'con_id' =>$con_id,
                    'created_at' =>date('Y-m-d H:i:s'),
                ]);
               // print_r('teacher');exit;
               return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/branch');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ'); 
            }
        }   
    }

    public function show($bran_id,Request $request)
    {
        if(is_numeric($bran_id))
        {
            $branch = DB::table('branch')->where('bran_id',$bran_id)->first();
            if(!empty($branch))
            {
                return view('branch::frombranch',[
                    'branch'=>$branch
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/branch']);
    }
    public function update($bran_id,Request $request)
    {
        if(is_numeric($bran_id))
        {
            
            $bran_name = $request->get('bran_name');
            $con_id = $request->get('con_id');

            if(!empty($bran_name) && !empty($con_id))
            {
               
                DB::table('Branch')->where('bran_id',$bran_id)->update([
                    'bran_name' =>$bran_name,
                    'con_id' =>$con_id,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/branch');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ');
            }
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
    
    public function destroy($bran_id)
    {
        if(is_numeric($bran_id))
        {
            DB::table('branch')->where('bran_id',$bran_id)->update([
                'delete_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}