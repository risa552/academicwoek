<?php

namespace App\Modules\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        /*DB::table('admin')->insert([
            'first_name' => 'บัณฑิต',
        ]);  */
        $keyword =$request->get('keyword');
        
        $admin = DB::table('admin')
        ->whereNull('delete_at');
        if(!empty($keyword)){
            $admin->where(function ($query) use($keyword){
                $query->where('first_name','LIKE','%'.$keyword.'%');
                $query->where('last_name','LIKE','%'.$keyword.'%');
                $query->where('tel','LIKE','%'.$keyword.'%');
                $query->where('sex','LIKE','%'.$keyword.'%');
                $query->where('house','LIKE','%'.$keyword.'%');
                $query->where('email','LIKE','%'.$keyword.'%');
            });
        }
        $admin = $admin->paginate(10);
        return view('admin::admin',[
            'admin'=>$admin
        ]);
    }

    public function create()
    {
        return view('admin::fromadmin');
    
    }

    public function store(Request $request)
    {
        
        {
            $first_name = $request->get('first_name');
            $last_name = $request->get('last_name');
            $tel = $request->get('tel');
            $sex = $request->get('sex');
            $house = $request->get('house');
            $email = $request->get('email');

            if(!empty($first_name) && !empty($last_name) && !empty($tel) && !empty($sex) && !empty($house) && !empty($email) )
            {
                
                DB::table('admin')->insert([
                    'first_name' =>$first_name,
                    'last_name' =>$last_name,
                    'tel' =>$tel,
                    'sex' =>$sex,
                    'house' =>$house,
                    'email' =>$email,
                    'created_at' =>date('Y-m-d H:i:s'),
                ]);
               // print_r('admin');exit;
               return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/admin');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ'); 
            }
        }
    }

    public function show($id,Request $request)
    {
        if(is_numeric($id))
        {
            $admin = DB::table('admin')->where('id',$id)->first();
            if(!empty($admin))
            {
                return view('admin::fromadmin',[
                    'admin'=>$admin
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/admin']);
    }
    public function update($id,Request $request)
    {
        if(is_numeric($id))
        {
            
            $first_name = $request->get('first_name');
            $last_name = $request->get('last_name');
            $tel = $request->get('tel');
            $sex = $request->get('sex');
            $house = $request->get('house');
            $email = $request->get('email');

            if(!empty($first_name) && !empty($last_name) && !empty($tel) && !empty($sex) && !empty($house) && !empty($email) )
            {
               
                DB::table('admin')->where('id',$id)->update([
                    'first_name' =>$first_name,
                    'last_name' =>$last_name,
                    'tel' =>$tel,
                    'sex' =>$sex,
                    'house' =>$house,
                    'email' =>$email,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/admin');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ');
            }
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
    
    public function destroy($id)
    {
        if(is_numeric($id))
        {
            DB::table('admin')->where('id',$id)->update([
                'delete_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}
