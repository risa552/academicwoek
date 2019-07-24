<?php

namespace App\Modules\Subject;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        /*DB::table('subject')->insert([
            'sub_name' => 'ภาษาไทย',
        ]);  */
        $keyword =$request->get('keyword');
        
        $subject = DB::table('subject')
        ->whereNull('delete_at');
        if(!empty($keyword)){
            $subject->where(function ($query) use($keyword){
                $query->where('sub_name','LIKE','%'.$keyword.'%');
                $query->where('credit','LIKE','%'.$keyword.'%');
                $query->where('theory','LIKE','%'.$keyword.'%');
                $query->where('pracitice','LIKE','%'.$keyword.'%');
            });
        }
        $subject = $subject->paginate(10);
        return view('subject::subject',[
            'subject'=>$subject
        ]);
    }

    public function create()
    {
        return view('subject::fromsubject');
    
    }

    public function store(Request $request)
    {
        
        {
            $sub_name = $request->get('sub_name');
            $credit = $request->get('credit');
            $theory = $request->get('theory');
            $practice = $request->get('practice');
            
            if(!empty($sub_name) && !empty($credit) && !empty($theory) && !empty($practice) )
            {

                DB::table('subject')->insert([
                    'sub_name' =>$sub_name,
                    'credit' =>$credit,
                    'theory' =>$theory,
                    'practice' =>$practice,
                    'created_at' =>date('Y-m-d H:i:s'),
                ]);
               // print_r('subject');exit;
               return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/subject');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ'); 
            }
        }
    }

    public function show($sub_id,Request $request)
    {
        if(is_numeric($sub_id))
        {
            $subject = DB::table('subject')->where('sub_id',$sub_id)->first();
            if(!empty($subject))
            {
                return view('subject::fromsubject',[
                    'subject'=>$subject
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/subject']);
    }
    public function update($sub_id,Request $request)
    {
        if(is_numeric($sub_id))
        {
            
            $sub_name = $request->get('sub_name');
            $credit = $request->get('credit');
            $theory = $request->get('theory');
            $practice = $request->get('practice');

            if(!empty($sub_name) && !empty($credit) && !empty($theory) && !empty($practice) )

            {
               
                DB::table('subject')->where('sub_id',$sub_id)->update([
                    'sub_name' =>$sub_name,
                    'credit' =>$credit,
                    'theory' =>$theory,
                    'practice' =>$practice,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/subject');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ');
            }
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
    
    public function destroy($sub_id)
    {
        if(is_numeric($sub_id))
        {
            DB::table('subject')->where('sub_id',$sub_id)->update([
                'delete_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}
