<?php

namespace App\Modules\Branch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class BranchController extends Controller
{
    private $table_name = 'branch';
    private $table2 = 'course';
    private $table3 = 'program';

    public function index(Request $request)
    {
        $keyword =$request->get('keyword');
        $cou_id =$request->get('cou_id');
        $program_id =$request->get('program_id');

        $items = DB::table($this->table_name)
        ->select('branch.*','course.cou_name','program.program_id')
        ->leftJoin('course','branch.cou_id','course.cou_id')
        ->leftJoin('program','branch.program_id','program.program_id')
        ->whereNull('branch.delete_at');

        if(!empty($keyword))
        {
            $items->where(function ($query) use($keyword){
                $query->where('bran_name','LIKE','%'.$keyword.'%');
            });
        }
        if(is_numeric($cou_id))
        {
            $items->where('branch.cou_id','=',$cou_id);
        }
        if(is_numeric($program_id))
        {
            $items->where('branch.program_id','=',$program_id);
        }
        $items = $items->orderBy('bran_name','asc')->paginate(10);
        $items2 = DB::table($this->table2)->whereNull('delete_at')->get();
        $items3 = DB::table($this->table3)->whereNull('delete_at')->get();
        return view($this->table_name.'::list',compact('items','items2','items3'));
    }
    
    public function create()
    {
        $items2 = DB::table($this->table2)->whereNull('delete_at')->get();
        $items3 = DB::table($this->table3)->whereNull('delete_at')->get();
        return view($this->table_name.'::form',compact('items2','items3'));
    }
    
    public function store(Request $request)
    {
        $bran_name = $request->get('bran_name');
        $cou_id = $request->get('cou_id');
        $program_id = $request->get('program_id');
        
        if( !empty($bran_name) && !empty($cou_id) && !empty($program_id))
        {
            $items = DB::table($this->table_name)
            ->where('bran_name',$bran_name)
            ->whereNull('delete_at')->first();
            if(!empty($items))
            {
                return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้ว');
            }   
            DB::table($this->table_name)->insert([
                'bran_name' =>$bran_name,
                'cou_id' =>$cou_id,
                'program_id' =>$program_id,
                'created_at' =>date('Y-m-d H:i:s'),
                //'created_at' =>date('Y-m-d H::i::s'),
            ]);
            return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/branch');
        }else{
            return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยคะ');
        }
    }

    public function show($id,Request $request)
    {
        if(is_numeric($id))
        {
            $items = DB::table($this->table_name)->where('bran_id',$id)->first();
            if(!empty($items))
            {
                $items2 = DB::table($this->table2)->whereNull('delete_at')->get();
                $items3 = DB::table($this->table3)->whereNull('delete_at')->get();
                return view($this->table_name.'::form',[
                    'items'=>$items,
                    'items2'=>$items2,
                    'items3'=>$items3,
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/branch']);
    }

    public function update($id,Request $request)
    {
        if(is_numeric($id))
        {
            $bran_name = $request->get('bran_name');
            $cou_id = $request->get('cou_id');
            $program_id = $request->get('program_id');
            
            if( !empty($bran_name) && !empty($cou_id) && !empty($program_id))
            {
                $items = DB::table($this->table_name)
                    ->where('bran_id','!=',$id)
                    ->where('bran_name',$bran_name)
                    ->whereNull('delete_at')->first();
                if(!empty($items)){
                    return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้ว');
                }
                DB::table($this->table_name)->where('bran_id',$id)->update([
                    'bran_name' =>$bran_name,
                    'cou_id' =>$cou_id,
                    'program_id' =>$program_id,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/branch');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยคะ');
            }
        }  
            return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }

    public function destroy($id)
    {
        if(is_numeric($id))
        {
            $exists = DB::table('studygroup')
            ->where('bran_id',$id)
            ->whereNull('delete_at')->first();
            if(!empty($exists))
            {
                return MyResponse::error('ขออภัยไม่สามารถลบรายการนีได้');
            }   
            DB::table($this->table_name)->where('bran_id',$id)->update([
                'delete_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}