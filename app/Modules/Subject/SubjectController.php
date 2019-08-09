<?php

namespace App\Modules\Subject;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class SubjectController extends Controller
{
    private $table_name = 'subject';
    private $table2 = 'subjectgroup';

    public function index(Request $request)
    {
        
        $keyword =$request->get('keyword');
        $subgroup_id =$request->get('subgroup_id');
        
        $items = DB::table($this->table_name)
        ->select('subject.*','subjectgroup.subgroup_name')
        ->leftJoin('subjectgroup','subject.subgroup_id','subjectgroup.subgroup_id')
        ->whereNull('subject.delete_at');

        if(!empty($keyword)){
            $items->where(function ($query) use($keyword){
                $query->where('sub_name','LIKE','%'.$keyword.'%')
                      ->orwhere('credit','LIKE','%'.$keyword.'%')
                      ->orwhere('theory','LIKE','%'.$keyword.'%')
                      ->orwhere('practice','LIKE','%'.$keyword.'%');
            });
        }
        if(is_numeric($subgroup_id))
        {
            $items->where('subject.subgroup_id','=',$subgroup_id);
        }
        $items = $items->paginate(10);
        $items2 = DB::table($this->table2)->whereNull('delete_at')->get();
        return view($this->table_name.'::subject',compact('items','items2'));
    }

    public function create()
    {
        $items2 = DB::table($this->table2)->whereNull('delete_at')->get();
        return view($this->table_name.'::fromsubject',compact('items2'));
    }

    public function store(Request $request)
    {
            $sub_name = $request->get('sub_name');
            $sub_code = $request->get('sub_code');
            $credit = $request->get('credit');
            $theory = $request->get('theory');
            $practice = $request->get('practice');
            $subgroup_id = $request->get('subgroup_id');
            
            if(!empty($sub_name) && !empty($credit) && !empty($sub_code) && !empty($theory) && !empty($practice)  && !empty($subgroup_id) )
            {
                $items = DB::table($this->table_name)
                ->where('sub_name',$sub_name)
                ->whereNull('delete_at')->first();
                if(!empty($items))
                {
                    return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้ว');
                }   
                DB::table($this->table_name)->insert([
                    'sub_name' =>$sub_name,
                    'sub_code' =>$sub_code,
                    'credit' =>$credit,
                    'theory' =>$theory,
                    'practice' =>$practice,
                    'subgroup_id' =>$subgroup_id,
                    'created_at' =>date('Y-m-d H:i:s'),
                ]);
               //print_r('subject');exit;
               return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/subject');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ'); 
            }
    }

    public function show($id,Request $request)
    {
        if(is_numeric($id))
        {
            $items = DB::table($this->table_name)->where('sub_id',$id)->first();
            if(!empty($items))
            {
                $items2 = DB::table($this->table2)->whereNull('delete_at')->get();
                return view($this->table_name.'::fromsubject',[
                    'items'=>$items,
                    'items2'=>$items2,
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/subject']);
    }

    public function update($id,Request $request)
    {
        if(is_numeric($id))
        {
            $sub_name = $request->get('sub_name');
            $sub_code = $request->get('sub_code');
            $credit = $request->get('credit');
            $theory = $request->get('theory');
            $practice = $request->get('practice');
            $subgroup_id = $request->get('subgroup_id');
            
            if(!empty($sub_name) && !empty($credit) && !empty($sub_code) && !empty($theory) && !empty($practice)  && !empty($subgroup_id) )
            {
                $items = DB::table($this->table_name)
                    ->where('sub_id','!=',$id)
                    ->where('sub_name',$sub_name)
                    ->whereNull('delete_at')->first();
                if(!empty($items)){
                    return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้ว');
                }
                DB::table($this->table_name)->where('sub_id',$id)->update([
                    'sub_name' =>$sub_name,
                    'sub_code' =>$sub_code,
                    'credit' =>$credit,
                    'theory' =>$theory,
                    'practice' =>$practice,
                    'subgroup_id' =>$subgroup_id,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/subject');
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
            ->where('sub_id',$id)
            ->whereNull('delete_at')->first();
            if(!empty($exists1))
            {
                return MyResponse::error('ขออภัยไม่สามารถลบรายการนีได้');
            }   
            DB::table($this->table_name)->where('sub_id',$id)->update([
                'delete_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}
