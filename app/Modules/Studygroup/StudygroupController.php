<?php

namespace App\Modules\Studygroup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class StudygroupController extends Controller
{
    private $table_name = 'studygroup';
    private $table2 = 'branch';
    private $table3 = 'degree';

    public function index(Request $request)
    {
        $keyword =$request->get('keyword');
        $bran_id =$request->get('bran_id');
        $degree_id =$request->get('degree_id');

        $group = DB::table($this->table_name)
        ->select('studygroup.*','branch.bran_name','degree.degree_name')
        ->leftJoin('branch','studygroup.bran_id','branch.bran_id')
        ->leftJoin('degree','studygroup.degree_id','degree.degree_id')
        ->whereNull('studygroup.delete_at');

        if(!empty($keyword))
        {
            $group->where(function ($query) use($keyword){
                $query->where('group_name','LIKE','%'.$keyword.'%')
                      ->orwhere('year','LIKE','%'.$keyword.'%');
            });
        }
        if(is_numeric($bran_id))
        {
            $group->where('studygroup.bran_id','=',$bran_id);
        }
        if(is_numeric($degree_id))
        {
            $group->where('studygroup.degree_id','=',$degree_id);
        }
        $group = $group->orderBy('studygroup.year','asc')->paginate(10);
        $branch = DB::table($this->table2)->whereNull('delete_at')->get();
        $degree = DB::table($this->table3)->whereNull('delete_at')->get();
        return view($this->table_name.'::list',compact('group','branch','degree'));
    }
    
    public function create()
    {
        $branch = DB::table($this->table2)->whereNull('delete_at')->get();
        $degree = DB::table($this->table3)->whereNull('delete_at')->get();
        return view($this->table_name.'::form',compact('branch','degree'));
    }
    
    public function store(Request $request)
    {
        $group_name = $request->get('group_name');
        $year = $request->get('year');
        $bran_id = $request->get('bran_id');
        $degree_id = $request->get('degree_id');
        
        if( !empty($group_name) && !empty($year) && !empty($bran_id) && !empty($degree_id))
        {
            $group = DB::table($this->table_name)
            ->where('group_name',$group_name)
            ->whereNull('delete_at')->first();
            if(!empty($group))
            {
                return MyResponse::error('ขออภัยข้อมูลกลุ่มเรียนนี้มีอยู่ในระบบแล้ว');
            }   
            DB::table($this->table_name)->insert([
                'group_name' =>$group_name,
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

    public function show($group_id,Request $request)
    {
        if(is_numeric($group_id))
        {
            $group = DB::table($this->table_name)->where('group_id',$group_id)->first();
            if(!empty($group))
            {
                $branch = DB::table($this->table2)->whereNull('delete_at')->get();
                $degree = DB::table($this->table3)->whereNull('delete_at')->get();
                return view($this->table_name.'::form',[
                    'group'=>$group,
                    'branch'=>$branch,
                    'degree'=>$degree
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/studygroup']);
    }

    public function update($group_id,Request $request)
    {
        if(is_numeric($group_id))
        {
            $group_name = $request->get('group_name');
            $year = $request->get('year');
            $bran_id = $request->get('bran_id');
            $degree_id = $request->get('degree_id');
            
            if( !empty($group_name) && !empty($year) && !empty($bran_id) && !empty($degree_id))
            {
                $group = DB::table($this->table_name)
            ->where('group_id','!=',$group_id)
            ->where('group_name',$group_name)
            ->whereNull('delete_at')->first();
            if(!empty($group)){
                return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้ว');
            }
                DB::table($this->table_name)->where('group_id',$group_id)->update([
                    'group_name' =>$group_name,
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

    public function destroy($group_id)
    {
        if(is_numeric($group_id))
        {
            DB::table($this->table_name)->where('group_id',$group_id)->update([
                'delete_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}