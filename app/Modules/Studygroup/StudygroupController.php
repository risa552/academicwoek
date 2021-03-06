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
        $teach_id =$request->get('teach_id');

        $group = DB::table($this->table_name)
        ->select('studygroup.*',
        'branch.bran_name',
        'degree.degree_name',
        'teacher.first_name',
        'teacher.last_name',
        'course.cou_name',
        'year.year_name')
        ->leftJoin('branch','studygroup.bran_id','branch.bran_id')
        ->leftJoin('degree','studygroup.degree_id','degree.degree_id')
        ->leftJoin('teacher','studygroup.teach_id','teacher.teach_id')
        ->leftJoin('program','studygroup.program_id','program.program_id')
        ->leftJoin('course','course.cou_id','program.cou_id')
        ->leftJoin('year','year.year_id','program.year_id')
        ->whereNull('studygroup.deleted_at');

        if(!empty($keyword))
        {
            $group->where(function ($query) use($keyword){
                $query->where('group_name','LIKE','%'.$keyword.'%')
                      ->orwhere('year_id','LIKE','%'.$keyword.'%');
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
        if(is_numeric($teach_id))
        {
            $group->where('studygroup.teach_id','=',$teach_id);
        }
        $group = $group->orderBy('studygroup.created_at','desc')->paginate(10);
        $program = DB::table('program')
        ->select('program.*',
        'course.cou_name',
        'year.year_name')
        ->leftJoin('course','course.cou_id','program.cou_id')
        ->leftJoin('year','year.year_id','program.year_id')
        ->whereNull('program.deleted_at')->get();
        $branch = DB::table($this->table2)->whereNull('deleted_at')->get();
        $degree = DB::table($this->table3)->whereNull('deleted_at')->get();
        $teach = DB::table('teacher')->whereNull('deleted_at')->get();
        return view($this->table_name.'::list',compact('group','branch','degree','teach','program'));
    }
    
    public function create()
    {
        $branch = DB::table($this->table2)->whereNull('deleted_at')->get();
        $degree = DB::table($this->table3)->whereNull('deleted_at')->get();
        $teach = DB::table('teacher')->whereNull('deleted_at')->get();
        $program = DB::table('program')
        ->select('program.*',
        'course.cou_name',
        'year.year_name')
        ->leftJoin('course','course.cou_id','program.cou_id')
        ->leftJoin('year','year.year_id','program.year_id')
        ->whereNull('program.deleted_at')->get();
        return view($this->table_name.'::form',compact('branch','degree','teach','program'));
    }
    
    public function store(Request $request)
    {
        $group_name = $request->get('group_name');
        $year_id = $request->get('year_id');
        $bran_id = $request->get('bran_id');
        $degree_id = $request->get('degree_id');
        $teach_id = $request->get('teach_id');
        $group_type = $request->get('group_type');
        $program_id = $request->get('program_id');
        
        if( !empty($group_name) && !empty($year_id) && !empty($bran_id) && !empty($degree_id) && !empty($teach_id) && !empty($group_type))
        {
            $group = DB::table($this->table_name)
            ->where('group_name',$group_name)
            ->whereNull('deleted_at')->first();
            if(!empty($group))
            {
                return MyResponse::error('ขออภัยข้อมูลกลุ่มเรียนนี้มีอยู่ในระบบแล้ว');
            }   
            DB::table($this->table_name)->insert([
                'group_name' =>$group_name,
                'year_id' =>$year_id,
                'bran_id' =>$bran_id,
                'degree_id'=>$degree_id,
                'teach_id'=>$teach_id,
                'group_type'=>$group_type,
                'program_id'=>$program_id,
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
                $branch = DB::table($this->table2)->whereNull('deleted_at')->get();
                $degree = DB::table($this->table3)->whereNull('deleted_at')->get();
                $teach = DB::table('teacher')->whereNull('deleted_at')->get();
                $program = DB::table('program')
                ->select('program.*',
                'course.cou_name',
                'year.year_name')
                ->leftJoin('course','course.cou_id','program.cou_id')
                ->leftJoin('year','year.year_id','program.year_id')
                ->whereNull('program.deleted_at')->get();
                return view($this->table_name.'::form',[
                    'group'=>$group,
                    'branch'=>$branch,
                    'degree'=>$degree,
                    'teach'=>$teach,
                    'program'=>$program,
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
            $year_id = $request->get('year_id');
            $bran_id = $request->get('bran_id');
            $degree_id = $request->get('degree_id');
            $teach_id = $request->get('teach_id');
            $group_type = $request->get('group_type');
            $program_id = $request->get('program_id');
            
            if( !empty($group_name) && !empty($year_id) && !empty($bran_id) && !empty($degree_id) && !empty($teach_id) && !empty($group_type))
            {
                $group = DB::table($this->table_name)
            ->where('group_id','!=',$group_id)
            ->where('group_name',$group_name)
            ->whereNull('deleted_at')->first();
            if(!empty($group)){
                return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้ว');
            }
                DB::table($this->table_name)->where('group_id',$group_id)->update([
                    'group_name' =>$group_name,
                    'year_id' =>$year_id,
                    'bran_id' =>$bran_id,
                    'degree_id'=>$degree_id,
                    'teach_id'=>$teach_id,
                    'group_type'=>$group_type,
                    'program_id'=>$program_id,
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
            $exists = DB::table('student')
            ->where('group_id',$group_id)
            ->whereNull('deleted_at')->first();
            if(!empty($exists))
            {
                return MyResponse::error('ขออภัยไม่สามารถลบรายการนีได้');
            }   
            DB::table($this->table_name)->where('group_id',$group_id)->update([
                'deleted_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}