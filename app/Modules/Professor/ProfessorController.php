<?php

namespace App\Modules\Professor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class ProfessorController extends Controller
{
    public function index(Request $request)
    {
        
        /*DB::table('teacher')->insert([
            'first_name' => 'มงคล',
            'last_name' => 'ณ ลำพูน',
            'ceated_at' =>date('Y-m-d H:i:s'),
            'Tel' => '08xxxxxxx',
            'Sex' => 'man',
            'Add' => 'นนทบุรี',
            'Email' => 'sa@gmail.com',
            'Username' => 'xxx',
            'Password' => '123456',
            'RigthID' => '01' 
        ]);  */
        $keyword =$request->get('keyword');
        
        $teacher = DB::table('teacher')
        ->whereNull('delete_at');
        if(!empty($keyword)){
            $teacher->where(function ($query) use($keyword){
                $query->where('frist_name','LIKE','%'.$keyword.'%')
                      ->orwhere('last_name','LIKE','%'.$keyword.'%')
                      ->orwhere('Email','LIKE','%'.$keyword.'%');
            });
        }
        $teacher = $teacher->get();
        return view('professor::professor',[
            'teacher'=>$teacher
        ]);
    }

    public function create()
    {
        return view('professor::fromprof');
    
    }

    public function store(Request $request)
    {
        
        {
            $first_name = $request->get('first_name');
            $last_name = $request->get('last_name');
            $Tel = $request->get('Tel');
            $sex = $request->get('sex');
            //$Tel = $request->get('Tel');
            $Add = $request->get('Add');
            $email = $request->get('email');
            $rigthid = $request->get('rigthid');

            if(!empty($first_name) && !empty($last_name) && !empty($Tel) && !empty($sex) && !empty($Add) && !empty($email) && !empty($rigthid) )
            {
               
                DB::table('teacher')->insert([
                    'first_name' =>$first_name,
                    'last_name' =>$last_name,
                    'Tel' =>$Tel,
                    'sex' =>$sex,
                    'Add' =>$Add,
                    'email' =>$email,
                    'rigthid' =>$rigthid,
                    'created_at' =>date('Y-m-d H:i:s'),
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
            $professor = DB::table('teacher')->where('id',$id)->first();
            if(!empty($professor))
            {
                return view('professor::fromprof',[
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
            $Tel = $request->get('Tel');
            $sex = $request->get('sex');
            //$Tel = $request->get('Tel');
            $Add = $request->get('Add');
            $email = $request->get('email');
            $rigthid = $request->get('rigthid');

            if(!empty($first_name) && !empty($last_name) && !empty($Tel) && !empty($sex) && !empty($Add) && !empty($email) && !empty($rigthid) )
            {
               
                DB::table('teacher')->where('id',$id)->update([
                    'first_name' =>$first_name,
                    'last_name' =>$last_name,
                    'Tel' =>$Tel,
                    'sex' =>$sex,
                    'Add' =>$Add,
                    'email' =>$email,
                    'rigthid' =>$rigthid,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
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
            DB::table('teacher')->where('id',$id)->update([
                'delete_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}
