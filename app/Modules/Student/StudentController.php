<?php

namespace App\Modules\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
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
                $query->where('name','LIKE','%'.$keyword.'%')
                      ->orwhere('std_fname','LIKE','%'.$keyword.'%')
                      ->orwhere('std_lname','LIKE','%'.$keyword.'%')
                      ->orwhere('email','LIKE','%'.$keyword.'%');
            });
        }
        if(is_numeric($group_id))
        {
            $items->where('student.group_id','=',$group_id);
        }
        $items = $items->orderBy('student.add','asc')->paginate(10);
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
        $name = $request->get('name');
        $std_fname = $request->get('std_fname');
        $std_lname = $request->get('std_lname');
        $tel = $request->get('tel');
        $sex = $request->get('sex');
        $add = $request->get('add');
        $email = $request->get('email');
        $group_id = $request->get('group_id');

        if( !empty($name) && !empty($std_fname) && !empty($std_lname) && !empty($tel) && !empty($sex) && !empty($add) && !empty($email) && !empty($group_id))
        {
            $items = DB::table($this->table_name)
            ->where('std_fname',$std_fname)
            ->whereNull('delete_at')->first();
            if(!empty($items))
            {
                return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้ว');
            }   
            DB::table($this->table_name)->insert([
                'name'=>$name,
                'std_fname'=>$std_fname,
                'std_lname'=>$std_lname,
                'tel'=>$tel,
                'sex'=>$sex,
                'add'=>$add,
                'email'=>$email,
                'group_id'=>$group_id,
                'created_at' =>date('Y-m-d H:i:s'),
                //'created_at' =>date('Y-m-d H::i::s'),
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
            $items = DB::table($this->table_name)->where('std_id',$std_id)->first();
            if(!empty($items))
            {
                $studygroup = DB::table($this->table2)->whereNull('delete_at')->get();
                return view($this->table_name.'::form',[
                    'items'=>$items,
                    'studygroup'=>$studygroup,
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/student']);
    }

    public function update($std_id,Request $request)
    {
        if(is_numeric($std_id))
        {
            $name = $request->get('name');
            $std_fname = $request->get('std_fname');
            $std_lname = $request->get('std_lname');
            $tel = $request->get('tel');
            $sex = $request->get('sex');
            $add = $request->get('add');
            $email = $request->get('email');
            $group_id = $request->get('group_id');
        if( !empty($name) && !empty($std_fname) && !empty($std_lname) && !empty($tel) && !empty($sex) && !empty($add) && !empty($email) && !empty($group_id))
        {
                $items = DB::table($this->table_name)
            ->where('std_id','!=',$std_id)
            ->where('std_fname',$std_fname)
            ->whereNull('delete_at')->first();
            if(!empty($items)){
                return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้ว');
            }
                DB::table($this->table_name)->where('std_id',$std_id)->update([
                   
                    'name'=>$name,
                    'std_fname'=>$std_fname,
                    'std_lname'=>$std_lname,
                    'tel'=>$tel,
                    'sex'=>$sex,
                    'add'=>$add,
                    'email'=>$email,
                    'group_id'=>$group_id,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
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