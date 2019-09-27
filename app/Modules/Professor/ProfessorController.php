<?php

namespace App\Modules\Professor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use stdClass;
use Hash;
use App\Services\MyResponse;
//use App\Services\CurrentUser;

class ProfessorController extends Controller
{
    public function index(Request $request)
    {
        $keyword =$request->get('keyword');
        
        $teacher = DB::table('teacher')
        ->whereNull('delete_at');
        if(!empty($keyword)){
            $teacher->where(function ($query) use($keyword){
                $query->where('first_name','LIKE','%'.$keyword.'%')
                      ->orwhere('last_name','LIKE','%'.$keyword.'%')
                      ->orwhere('email','LIKE','%'.$keyword.'%');
            });
        }
        $teacher = $teacher->paginate(10);
        return view('professor::professor',[
            'teacher'=>$teacher
        ]);
    }

    public function create()
    {
        return view('professor::fromprofessor');
    
    }

    public function store(Request $request)
    {
        {
            $first_name = $request->get('first_name');
            $last_name = $request->get('last_name');
            $tel = $request->get('tel');
            $sex = $request->get('sex');
            $add = $request->get('add');
            $email = $request->get('email');
            $username = $request->get('username');
            $password = $request->get('password');
            if(!empty($first_name) && !empty($last_name) && !empty($tel) && !empty($sex) && !empty($add) && !empty($email) && !empty($username) &&!empty($password))
            {
                $users = DB::table('users')
                ->where('username',$username)
                ->where('user_type','USER_LEVEL_TEACHER')
                ->where('status','Y')->first();
                if(!empty($users)){
                    return MyResponse::error('Username นี้มีในระบบแล้ว');
                }

                $id=DB::table('teacher')->insertGetId([
                    'first_name' =>$first_name,
                    'last_name' =>$last_name,
                    'tel' =>$tel,
                    'sex' =>$sex,
                    'Add' =>$add,
                    'email' =>$email,
                    'created_at' =>date('Y-m-d H:i:s'),
                ]);
                DB::table('users')->insert([
                    'user_type' =>'USER_LEVEL_TEACHER',
                    'user_id' =>$id,
                    'username' =>$username,
                    'password' =>Hash::make($password),
                    'created_at' =>date('Y-m-d H:i:s'),
                    'status' =>'Y'
                ]);
               // print_r('teacher');exit;
               return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/professor');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ'); 
            }
        }   
    }

    public function show($id,Request $request)
    {
        if(is_numeric($id))
        {
            $professor = DB::table('teacher')
            ->select('teacher.*','users.username')
            ->leftJoin('users', function ($join) use($id) {
                $join->on('users.user_id', '=', 'teacher.teach_id')
                     ->where('user_type','USER_LEVEL_TEACHER')
                     ->where('status','Y');
            })
            ->where('teach_id',$id)->first();
            if(!empty($professor))
            {
               // print_r($professor);exit;
                return view('professor::fromprofessor',[
                    'professor'=>$professor
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/professor']);
    }

    public function update($id,Request $request)
    {
        if(is_numeric($id))
        {
            
            $first_name = $request->get('first_name');
            $last_name = $request->get('last_name');
            $Tel = $request->get('tel');
            $sex = $request->get('sex');
            $Add = $request->get('add');
            $email = $request->get('email');
            $username = $request->get('username');
            $password = $request->get('password');

            if(!empty($first_name) && !empty($last_name) && !empty($Tel) && !empty($sex) && !empty($Add) && !empty($email))
            {
                $teacher = DB::table('teacher')
            ->where('teach_id','!=',$id)
            ->where('first_name',$first_name)
            ->where('last_name',$last_name)
            ->whereNull('delete_at')->first();
            if(!empty($teacher)){
                return MyResponse::error('ขออภัยข้อมูลนี้มีในระบบแล้วคะ');
            }
                DB::table('teacher')->where('teach_id',$id)->update([
                    'first_name' =>$first_name,
                    'last_name' =>$last_name,
                    'tel' =>$Tel,
                    'sex' =>$sex,
                    'add' =>$Add,
                    'email' =>$email,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
                if(!empty($username))
                {   
                    $users = DB::table('users')
                        ->where('username',$username)
                        ->where('user_type','USER_LEVEL_TEACHER')
                        ->where('user_id','!=',$id)
                        ->where('status','Y')->first();
                        if(!empty($users)){
                            return MyResponse::error('Username นี้มีในระบบแล้ว');
                        }else{
                            DB::table('users')
                            ->where('user_type','USER_LEVEL_TEACHER')
                            ->where('user_id',$id)
                            ->where('user_type','USER_LEVEL_TEACHER')
                            ->where('status','Y')
                            ->update([
                                'username' =>$username,
                                'password' =>Hash::make($password)
                            ]);
                        }
                }
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/professor');
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
            $exists1 = DB::table('program')
            ->where('teach_id',$id)
            ->whereNull('delete_at')->first();
            if(!empty($exists1))
            {
                return MyResponse::error('ขออภัยไม่สามารถลบรายการนีได้');
            }   
            DB::table('teacher')->where('teach_id',$id)->update([
                'delete_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}
