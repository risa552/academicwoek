<?php

namespace App\Modules\Subjectgroup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class SubjectgroupController extends Controller
{
    private $table_name = 'subjectgroup';
    public function index(Request $request)
    {
        $keyword =$request->get('keyword');
        $items = DB::table($this->table_name)
        ->whereNull('deleted_at');
        if(!empty($keyword)){
            $items->where(function ($query) use($keyword){
                $query->where('subgroup_name','LIKE','%'.$keyword.'%');
            });
        }
        $items = $items->orderBy('subjectgroup.created_at','desc')->paginate(10);
        return view($this->table_name.'::list',[
            'items'=>$items
        ]);
    }
    
    public function create()
    {
        return view($this->table_name.'::from');
    }
    
    public function store(Request $request)
    {
        $subgroup_name = $request->get('subgroup_name');
        if( !empty($subgroup_name))
        {
            DB::table($this->table_name)->insert([
                'subgroup_name' =>$subgroup_name,
                'created_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/subjectgroup');
        }else{
            return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยคะ');
        }
    }

    public function show($id,Request $request)
    {
        if(is_numeric($id))
        {
            $item = DB::table($this->table_name)->where('subgroup_id',$id)->first();
            if(!empty($item))
            {
                return view($this->table_name.'::from',[
                    $this->table_name=>$item
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/subjectgroup']);
    }

    public function update($id,Request $request)
    {
        if(is_numeric($id))
        {
            $subgroup_name = $request->get('subgroup_name');
            if( !empty($subgroup_name))
            {
                DB::table($this->table_name)->where('subgroup_id',$id)->update([
                    'subgroup_name' =>$subgroup_name,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/subjectgroup');
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
            $exists = DB::table('subject')
            ->where('subgroup_id',$id)
            ->whereNull('deleted_at')->first();
            if(!empty($exists))
            {
                return MyResponse::error('ขออภัยไม่สามารถลบรายการนีได้');
            }   
            DB::table($this->table_name)->where('subgroup_id',$id)->update([
                'deleted_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}