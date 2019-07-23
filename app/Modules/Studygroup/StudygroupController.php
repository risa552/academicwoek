<?php

namespace App\Modules\Studygroup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class StudygroupController extends Controller
{
    public function index(Request $request)
    {
        $keyword =$request->get('keyword');
        $studygroup = DB::table('studygroup')
        ->whereNull('delete_at');
        if(!empty($keyword)){
            $studygroup->where(function ($query) use($keyword){
                $query->where('group','LIKE','%'.$keyword.'%')
                      ->orwhere('year','LIKE','%'.$keyword.'%');
            });
        }
        $studygroup = $studygroup->get();
        return view('studygroup::group',[
            'studygroup'=>$studygroup
        ]);
    }
    
    public function create()
    {
        return view('studygroup::fromgroup');
    }
    
    public function store(Request $request)
    {
        $group = $request->get('group');
        $year = $request->get('year');
        $bran_id = $request->get('bran_id');
        $degree_id = $request->get('degree_id');
        
        if( !empty($group) && !empty($year) && !empty($bran_id) && !empty($degree_id))
        {
            DB::table('studygroup')->insert([
                'group' =>$group,
                'year' =>$year,
                'bran_id' =>$bran_id,
                'degree_id'=>$degree_id,
                'created_at' =>date('Y-m-d H:i:s'),
                //'created_at' =>date('Y-m-d H::i::s'),
            ]);
            return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/studygroup');
        }else{
            return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยคะ');
        }
    }

    public function show($id,Request $request)
    {
        if(is_numeric($id))
        {
            $studygroup = DB::table('studygroup')->where('id',$id)->first();
            if(!empty($studygroup))
            {
                return view('studygroup::fromgroup',[
                    'studygroup'=>$studygroup
                ]);
            }
           
        }
    
        return view('data-not-found',['back_url'=>'/studygroup']);
    }

    public function update($id,Request $request)
    {
        if(is_numeric($id))
        {
            $group = $request->get('group');
            $year = $request->get('year');
            $bran_id = $request->get('bran_id');
            $degree_id = $request->get('degree_id');
            
            if( !empty($group) && !empty($year) && !empty($bran_id) && !empty($degree_id))
            {
                DB::table('studygroup')->where('id',$id)->update([
                    'group' =>$group,
                    'year' =>$year,
                    'bran_id' =>$bran_id,
                    'degree_id'=>$degree_id,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/studygroup');
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
            DB::table('studygroup')->where('id',$id)->update([
                'delete_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}