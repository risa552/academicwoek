<?php

namespace App\Modules\Subjectgroup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class SubjectgroupController extends Controller
{
    public function index(Request $request)
    {
        $keyword =$request->get('keyword');
        $subjectgroup = DB::table('subjectgroup')
        ->whereNull('delete_at');
        if(!empty($keyword)){
            $subjectgroup->where(function ($query) use($keyword){
                $query->where('subgroup_name','LIKE','%'.$keyword.'%');
            });
        }
        $subjectgroup = $subjectgroup->get();
        return view('subjectgroup::subjectg',[
            'subjectgroup'=>$subjectgroup
        ]);
    }
    
    public function create()
    {
        return view('subjectgroup::from');
    }
    
    public function store(Request $request)
    {
        $subgroup_name = $request->get('subgroup_name');
       
        
        if( !empty($subgroup_name))
        {
            DB::table('subjectgroup')->insert([
                'subgroup_name' =>$subgroup_name,
                'created_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/subjectgroup');
        }else{
            return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยคะ');
        }
    }

    public function show($subgroup_id,Request $request)
    {
        if(is_numeric($subgroup_id))
        {
            $subjectgroup = DB::table('subjectgroup')->where('subgroup_id',$subgroup_id)->first();
            if(!empty($subjectgroup))
            {
                return view('subjectgroup::from',[
                    'subjectgroup'=>$subjectgroup
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/subjectgroup']);
    }

    public function update($subgroup_id,Request $request)
    {
        if(is_numeric($subgroup_id))
        {
            $subgroup_name = $request->get('subgroup_name');
            if( !empty($subgroup_name))
            {
                DB::table('subjectgroup')->where('subgroup_id',$subgroup_id)->update([
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
    public function destroy($subgroup_id)
    {
        if(is_numeric($subgroup_id))
        {
            DB::table('subjectgroup')->where('subgroup_id',$subgroup_id)->update([
                'delete_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}