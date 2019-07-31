<?php

namespace App\Modules\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use Hash;
use App\Services\MyResponse;

class StudentController extends Controller
{
    private $table_name = 'student';
    private $table2 = 'studygroup';

    public function index(Request $request)
    {
        $keyword =$request->get('keyword');
        $group_id =$request->get('group_id');

        $items = DB::table($this->table_name)
        ->select('student.*','studygroup.group_name')
        ->leftJoin('studygroup','student.group_id','studygroup.group_id')
        ->whereNull('student.delete_at');

        if(!empty($keyword))
        {
            $items->where(function ($query) use($keyword){
                $query->where('number','LIKE','%'.$keyword.'%')
                      ->orwhere('first_name','LIKE','%'.$keyword.'%')
                      ->orwhere('last_name','LIKE','%'.$keyword.'%')
                      ->orwhere('email','LIKE','%'.$keyword.'%');
            });
        }
        if(is_numeric($group_id))
        {
            $items->where('student.group_id','=',$group_id);
        }
        $items = $items->orderBy('student.first_name','asc')->paginate(10);
        $studygroup = DB::table($this->table2)->whereNull('delete_at')->get();
        return view($this->table_name.'::list',compact('items','studygroup'));
    }
    
    public function create()
    {
        $studygroup = DB::table($this->table2)->whereNull('delete_at')->get();
        return view($this->table_name.'::form',compact('studygroup'));
    }
    
    public function store(Request $request)
    {
        $number = $request->get('number');
        $first_name = $request->get('first_name');
        $last_name = $request->get('last_name');
        $tel = $request->get('tel');
        $sex = $request->get('sex');
        $add = $request->get('add');
        $email = $request->get('email');
        $group_id = $request->get('group_id');
        $username = $request->get('username');
        $password = $request->get('password');

        if( !empty($number) && !empty($username) && !empty($password) && !empty($first_name) && !empty($last_name) && !empty($tel) && !empty($sex) && !empty($add) && !empty($email) && !empty($group_id))
        {
            $items = DB::table($this->table_name)
            ->where('first_name',$first_name)
            ->where('last_name',$last_name)
            ->whereNull('student.delete_at')->first();
            if(!empty($student))
            {
                return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้วค่ะ');
            }   
            $users = DB ::table ('users')
            ->where('username',$username)
            ->where('user_type','USER_LEVEL_STUDENT')
            ->where('status','Y')->first();
            if(!empty($users)){
                return MyResponse::error('Username นี้มีในระบบแล้วค่ะ');
            }
        
         $std_id = DB::table('student')->insertGetId([
                'number'=>$number,
                'first_name'=>$first_name,
                'last_name'=>$last_name,
                'tel'=>$tel,
                'sex'=>$sex,
                'add'=>$add,
                'email'=>$email,
                'group_id'=>$group_id,
                'created_at' =>date('Y-m-d H:i:s'),
                //'created_at' =>date('Y-m-d H::i::s'),
            ]);
            DB::table('users')
            ->insert([
                    'user_type' =>'USER_LEVEL_STUDENT',
                    'user_id' =>$std_id,
                    'username' =>$username,
                    'password' =>Hash::make($password),
                    'created_at' =>date('Y-m-d H:i:s'),
                    'status' =>'Y'
            ]);
            return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/student');
        }else{
            return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ');
        }
    }

    public function show($std_id,Request $request)
    {
        if(is_numeric($std_id))
        {
            $student = DB::table('student')
            ->select('student.*','users.username')
            ->leftJoin('users', function ($join) use ($std_id) {
                $join->on('users.user_id', '=', 'student.std_id')
                    ->where('user_type','USER_LEVEL_STUDENT')
                    ->where('status','Y');
            })
            ->where('std_id',$std_id)->first();
            if(!empty($student))
            {
                $studygroup = DB::table($this->table2)->whereNull('delete_at')->get();
                return view($this->table_name.'::form',[
                    'student'=>$student,
                    'studygroup'=>$studygroup
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/student']);
    }

    public function update($std_id,Request $request)
    {
        if(is_numeric($std_id))
        {
            $number = $request->get('number');
            $first_name = $request->get('first_name');
            $last_name = $request->get('last_name');
            $tel = $request->get('tel');
            $sex = $request->get('sex');
            $add = $request->get('add');
            $email = $request->get('email');
            $group_id = $request->get('group_id');
            $username = $request->get('username');
            $password = $request->get('password');
            
        if( !empty($number) && !empty($first_name) && !empty($last_name) && !empty($tel) && !empty($sex) && !empty($add) && !empty($email) && !empty($group_id))
        {
                $items = DB::table($this->table_name)
            ->where('std_id','!=',$std_id)
            ->where('first_name',$first_name)
            ->where('last_name',$last_name)
            ->whereNull('delete_at')->first();
            if(!empty($items)){
                return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้ว');
            }
                DB::table($this->table_name)->where('std_id',$std_id)->update([
                    'number'=>$number,
                    'first_name'=>$first_name,
                    'last_name'=>$last_name,
                    'tel'=>$tel,
                    'sex'=>$sex,
                    'add'=>$add,
                    'email'=>$email,
                    'group_id'=>$group_id,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
                if(!empty($username)){
                    $users = DB::table ('users')
                        ->where('username',$username)
                        ->where('user_type','USER_LEVEL_STUDENT')
                        ->where('user_id','!=','std_id')
                        ->where('status','Y')->first();
                    if(!empty($users)){
                        return MyResponse::error ('username นี้มีในระบบแล้วค่ะ'); 
                    }else{
                        DB::table('users')
                        ->where('user_type','USER_LEVEL_STUDENT')
                        ->where('user_id',$std_id)
                        ->where('user_type','USER_LEVEL_STUDENT')
                        ->where('status','Y')
                        ->update([
                            'username' =>$username,
                            'password' =>Hash::make($password)
                        ]);
                    }
                }
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/student');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะะ');
            }
        }  
            return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }

    public function destroy($std_id)
    {
        if(is_numeric($std_id))
        {
            DB::table($this->table_name)->where('std_id',$std_id)->update([
                'delete_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}