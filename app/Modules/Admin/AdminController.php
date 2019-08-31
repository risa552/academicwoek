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
            $username = $request->get('username');
            $password = $request->get('password');

            if(!empty($first_name) && !empty($last_name) && !empty($tel) && !empty($sex) && !empty($house) && !empty($email) && !empty($username) && !empty($password))
            {
                $admin = DB::table('admin')
            ->where('first_name',$first_name)
            ->where('last_name',$last_name)
            ->whereNull('admin.delete_at')->first();
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
    }

    public function show($id,Request $request)
    {
        if(is_numeric($id))
        {
            $admin = DB::table('admin')
            ->select('admin.*','users.username')
            ->leftJoin('users', function ($join) use ($admin_id) {
                $join->on('users.user_id', '=', 'admin.admin_id')
                    ->where('user_type','USER_LEVEL_ADMIN')
                    ->where('status','Y');
            })
            ->where('admin_id',$admin_id)->first();
            $admin = DB::table('admin')->where('admin_id',$id)->first();
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
            $username = $request->get('username');
            $password = $request->get('password');

            if(!empty($first_name) && !empty($last_name) && !empty($tel) && !empty($sex) && !empty($house) && !empty($email) && !empty($username) && !empty($password))
            {
                $admin = DB::table('admin')
                ->where('admin_id','!=',$admin_id)
                ->where('first_name',$first_name)
                ->where('last_name',$last_name)
                ->whereNull('delete_at')->first();
                if(!empty($items)){
                    return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้ว');
                }
                DB::table('admin')->where('admin_id',$id)->update([
                    'first_name' =>$first_name,
                    'last_name' =>$last_name,
                    'tel' =>$tel,
                    'sex' =>$sex,
                    'house' =>$house,
                    'email' =>$email,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
                if(!empty($username)){
                    $users = DB::table ('users')
                        ->where('username',$username)
                        ->where('user_type','USER_LEVEL_ADMIN')
                        ->where('user_id','!=','admin_id')
                        ->where('status','Y')->first();
                    if(!empty($users)){
                        return MyResponse::error ('username นี้มีในระบบแล้วค่ะ'); 
                    }else{
                        DB::table('users')
                        ->where('user_type','USER_LEVEL_ADMIN')
                        ->where('user_id',$admin_id)
                        ->where('user_type','USER_LEVEL_ADMIN')
                        ->where('status','Y')
                        ->update([
                            'username' =>$username,
                            'password' =>Hash::make($password)
                        ]);
                    }
                }
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
            DB::table('admin')->where('admin_id',$id)->update([
                'delete_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}
