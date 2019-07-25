<?php

namespace App\Modules\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        /*DB::table('student')->insert([
            'std_fname' => 'เยาวเรศ',
        ]);  */
        $keyword =$request->get('keyword');
        
        $student = DB::table('student')
        ->whereNull('delete_at');
        if(!empty($keyword)){
            $student->where(function ($query) use($keyword){
                $query->where('std_fname','LIKE','%'.$keyword.'%');
                $query->where('std_lname','LIKE','%'.$keyword.'%');
                $query->where('email','LIKE','%'.$keyword.'%');
            });
        }
        $student = $student->paginate(10);
        return view('student::student',[
            'student'=>$student
        ]);
    }

    public function create()
    {
        return view('student::fromstudent');
    
    }

    public function store(Request $request)
    {
        
        {
            $std_fname = $request->get('std_fname');
            $std_lname = $request->get('std_lname');
            $tel = $request->get('tel');
            $sex = $request->get('sex');
            $add = $request->get('add');
            $email = $request->get('email');
            $group_id = $request->get('group_id');
            
            if(!empty($std_fname) && !empty($std_lname) && !empty($tel) && !empty($sex) && !empty($add) && !empty($email) && !empty($group_id))
            {

                DB::table('student')->insert([
                    'std_fname' =>$std_fname,
                    'std_lname' =>$std_lname,
                    'tel' =>$tel,
                    'sex' =>$sex,
                    'add' =>$add,
                    'email' =>$email,
                    'group_id' =>$group_id,
                    'created_at' =>date('Y-m-d H:i:s'),
                ]);
               // print_r('student');exit;
               return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/student');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ'); 
            }
        }
    }

    public function show($std_id,Request $request)
    {
        if(is_numeric($std_id))
        {
            $student = DB::table('student')->where('std_id',$std_id)->first();
            if(!empty($student))
            {
                return view('student::fromstudent',[
                    'student'=>$student
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/student']);
    }
    public function update($std_id,Request $request)
    {
        if(is_numeric($std_id))
        {
            
            $std_fname = $request->get('std_fname');
            $std_lname = $request->get('std_lname');
            $tel = $request->get('tel');
            $sex = $request->get('sex');
            $add = $request->get('add');
            $email = $request->get('email');
            $group_id = $request->get('group_id');
  
            if(!empty($std_fname) && !empty($std_lname) && !empty($tel) && !empty($sex) && !empty($add) && !empty($email) && !empty($group_id))
            
            {
               
                DB::table('student')->insert([
                    'std_fname' =>$std_fname,
                    'std_lname' =>$std_lname,
                    'tel' =>$tel,
                    'sex' =>$sex,
                    'add' =>$add,
                    'email' =>$email,
                    'group_id' =>$group_id,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/student');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ');
            }
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
    
    public function destroy($std_id)
    {
        if(is_numeric($std_id))
        {
            DB::table('student')->where('std_id',$std_id)->update([
                'delete_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}
