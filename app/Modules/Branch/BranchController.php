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

    public function index(Request $request)
    {
        $keyword =$request->get('keyword');
        $cou_id =$request->get('cou_id');

        $items = DB::table($this->table_name)
        ->select('branch.*','course.cou_name','course.cou_year')
        ->leftJoin('course','branch.cou_id','course.cou_id')
        ->whereNull('branch.deleted_at');

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
       
        $items = $items->orderBy('bran_name','asc')->paginate(10);
        $items2 = DB::table($this->table2)->whereNull('deleted_at')->get();
        return view($this->table_name.'::list',compact('items','items2'));
    }
    
    public function create()
    {
        $items2 = DB::table($this->table2)->whereNull('deleted_at')->get();
        return view($this->table_name.'::form',compact('items2'));
    }
    
    public function store(Request $request)
    {
        $bran_name = $request->get('bran_name');
        $cou_id = $request->get('cou_id');
        
        if( !empty($bran_name) && !empty($cou_id))
        {
            $items = DB::table($this->table_name)
            ->where('bran_name',$bran_name)
            ->whereNull('deleted_at')->first();
            if(!empty($items))
            {
                return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้ว');
            }   
            DB::table($this->table_name)->insert([
                'bran_name' =>$bran_name,
                'cou_id' =>$cou_id,
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
                $items2 = DB::table($this->table2)->whereNull('deleted_at')->get();
                return view($this->table_name.'::form',[
                    'items'=>$items,
                    'items2'=>$items2,
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
            
            if( !empty($bran_name) && !empty($cou_id) )
            {
                $items = DB::table($this->table_name)
                    ->where('bran_id','!=',$id)
                    ->where('bran_name',$bran_name)
                    ->whereNull('deleted_at')->first();
                if(!empty($items)){
                    return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้ว');
                }
                DB::table($this->table_name)->where('bran_id',$id)->update([
                    'bran_name' =>$bran_name,
                    'cou_id' =>$cou_id,
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
            ->whereNull('deleted_at')->first();
            if(!empty($exists))
            {
                return MyResponse::error('ขออภัยไม่สามารถลบรายการนีได้');
            }   
            DB::table($this->table_name)->where('bran_id',$id)->update([
                'deleted_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}