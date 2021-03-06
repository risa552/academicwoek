<?php

namespace App\Modules\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use Hash;
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
        ->whereNull('deleted_at');

        if(!empty($keyword))
        {
            $admin->where(function ($query) use($keyword){
                $query->where('first_name','LIKE','%'.$keyword.'%')
                      ->orwhere('last_name','LIKE','%'.$keyword.'%')
                      ->orwhere('tel','LIKE','%'.$keyword.'%')
                      ->orwhere('sex','LIKE','%'.$keyword.'%')
                      ->orwhere('house','LIKE','%'.$keyword.'%')
                      ->orwhere('email','LIKE','%'.$keyword.'%');
            });
        }
        $admin = $admin->paginate(10);
        return view('admin::admin',compact('admin'));
    }

    public function create()
    {
        return view('admin::fromadmin');
    
    }

    public function store(Request $request)
    {
            $first_name = $request->get('first_name');
            $last_name = $request->get('last_name');
            $tel = $request->get('tel');
            $sex = $request->get('sex');
            $house = $request->get('house');
            $email = $request->get('email');
            $username = $request->get('username');
            $password = $request->get('password');

            if(!empty($first_name) && !empty($last_name)  && !empty($sex) 
            && !empty($house)  && !empty($username) && !empty($password))
            {
                $admin = DB::table('admin')
            ->where('first_name',$first_name)
            ->where('last_name',$last_name)
            ->whereNull('admin.deleted_at')->first();
            if(!empty($admin))
            {
                return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้วค่ะ');
            }   
            $users = DB ::table ('users')
            ->where('username',$username)
            ->where('user_type','USER_LEVEL_ADMIN')
            ->where('status','Y')->first();
            if(!empty($users)){
                return MyResponse::error('Username นี้มีในระบบแล้วค่ะ');
            }
                $admin_id =DB::table('admin')->insertGetId([
                    'first_name' =>$first_name,
                    'last_name' =>$last_name,
                    'tel' =>$tel,
                    'sex' =>$sex,
                    'house' =>$house,
                    'email' =>$email,
                    'created_at' =>date('Y-m-d H:i:s'),
                ]);
                DB::table('users')
                ->insert([
                    'user_type' =>'USER_LEVEL_ADMIN',
                    'user_id' =>$admin_id,
                    'username' =>$username,
                    'password' =>Hash::make($password),
                    'created_at' =>date('Y-m-d H:i:s'),
                    'status' =>'Y'
                ]);
               // print_r('admin');exit;
               return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/admin');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ'); 
            }
    }

    public function show($admin_id,Request $request)
    {
        if(is_numeric($admin_id))
        {
            $admin = DB::table('admin')
            ->select('admin.*','users.username')
            ->leftJoin('users', function ($join) use ($admin_id) {
                $join->on('users.user_id', '=', 'admin.admin_id')
                    ->where('user_type','USER_LEVEL_ADMIN')
                    ->where('status','Y');
            })
            ->where('admin_id',$admin_id)->first();
            if(!empty($admin))
            {
                // $admin = DB::table('admin')->where('admin_id',$admin_id)->first();
                return view('admin::fromadmin',[
                    'admin'=>$admin
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/admin']);
    }
    public function update($admin_id,Request $request)
    {
        if(is_numeric($admin_id))
        {
            
            $first_name = $request->get('first_name');
            $last_name = $request->get('last_name');
            $tel = $request->get('tel');
            $sex = $request->get('sex');
            $house = $request->get('house');
            $email = $request->get('email');
            $username = $request->get('username');
            $password = $request->get('password');

            if(!empty($first_name) && !empty($last_name)  && !empty($sex) && !empty($house))
            {
                $admin = DB::table('admin')
                ->where('admin_id','!=',$admin_id)
                ->where('first_name',$first_name)
                ->where('last_name',$last_name)
                ->whereNull('deleted_at')->first();
                if(!empty($admin)){
                    return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้ว');
                }
                DB::table('admin')->where('admin_id',$admin_id)->update([
                    'first_name' =>$first_name,
                    'last_name' =>$last_name,
                    'tel' =>$tel,
                    'sex' =>$sex,
                    'house' =>$house,
                    'email' =>$email,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
                if(!empty($password)){
                        DB::table('users')
                        ->where('user_type','USER_LEVEL_ADMIN')
                        ->where('user_id',$admin_id)
                        ->where('user_type','USER_LEVEL_ADMIN')
                        ->where('status','Y')
                        ->update([
                            'password' =>Hash::make($password)
                        ]);
                }
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/admin');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ');
            }
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
    
    public function destroy($admin_id)
    {
        if(is_numeric($admin_id))
        {
            DB::table('admin')->where('admin_id',$admin_id)->update([
                'deleted_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}
