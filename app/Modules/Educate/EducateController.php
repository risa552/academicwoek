<?php

namespace App\Modules\Educate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class EducateController extends Controller
{

    public function index(Request $request)
    {
     
        $keyword = $request->get('keyword');
        $term_id = $request->get('term_id');
        $teach_id = $request->get('teach_id');
        $sub_id = $request->get('sub_id');
        $group_id = $request->get('group_id');

       // $user=CurrentUser::user();
        $items = DB::table('educate')
        ->select('educate.teach_id',
        'subject.sub_code',
        'subject.sub_name',
        'teacher.first_name',
        'teacher.last_name',
        'program.term_id',
        'studygroup.group_name')
        ->leftjoin('program', function ($join) {
            $join->on('program.term_id', '=', 'educate.term_id')
                 ->on('program.sub_id', '=', 'educate.sub_id');
        })
        ->leftJoin('subject','program.sub_id','subject.sub_id')
        ->leftJoin('teacher','educate.teach_id','teacher.teach_id')
        ->leftJoin('studygroup','teacher.teach_id','studygroup.teach_id')
    
        //->where('educate.teach_id',$user->teach_id)
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('term')
                  ->where('startdate','<=',date('Y-m-d'))
                  ->where('enddate','>=',date('Y-m-d'))
                  ->whereRaw('program.term_id = term.term_id');
        })
        ->whereNull('program.delete_at')
        ->whereNull('studygroup.delete_at');

        if(!empty($keyword)){
            $items->where(function ($query) use($keyword){
                $query->where('term_id','LIKE','%'.$keyword.'%');
            });
        }
        if(is_numeric($term_id))
        {
            $items->where('program.term_id','=',$term_id);
        }
        if(is_numeric($teach_id))
        {
            $items->where('educate.teach_id','=',$teach_id);
        }
        if(is_numeric($sub_id))
        {
            $items->where('program.sub_id','=',$sub_id);
        }
        if(is_numeric($group_id))
        {
            $items->where('teacher.group_id','=',$group_id);
        }
          //print_r($g1);exit;*/
        $items = $items->orderBy('teacher.first_name')->get();
        $teacher = DB::table('teacher')->whereNull('delete_at')->get();
        $subject = DB::table('subject')->whereNull('delete_at')->get();
        $studygroup = DB::table('studygroup')->whereNull('delete_at')->get();
        $term = DB::table('term')->whereNull('delete_at')->get();
        return view('educate::list',compact('items','teacher','subject','studygroup','term'));
    }

    public function create()
    {
        $items2 = DB::table($this->table2)->whereNull('delete_at')->get();
        $items3 = DB::table($this->table3)->whereNull('delete_at')->get();
        $items4 = DB::table($this->table4)->whereNull('delete_at')->get();
        return view('program::list',compact('items2','items3','items4'));
    
    }

    public function store(Request $request)
    {   
            $bran_id = $request->get('bran_id');
            $term_id = $request->get('term_id');
            $sub_id = $request->get('sub_id');

            if(!empty($bran_id) && !empty($term_id) && !empty($sub_id) )
            { 

                DB::table($this->table_name)->insert([
                    'bran_id' =>$bran_id,
                    'term_id' =>$term_id,
                    'sub_id' =>$sub_id,
                    'created_at' =>date('Y-m-d H:i:s'),
                ]);
               return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/program');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ'); 
            }
    }

    public function show($id,Request $request)
    {
        if(is_numeric($id))
        {
            $items = DB::table($this->table_name)->where('program_id',$id)->first();
            if(!empty($items))
            {
                $items2 = DB::table($this->table2)->whereNull('delete_at')->get();
                $items3 = DB::table($this->table3)->whereNull('delete_at')->get();
                $items4 = DB::table($this->table4)->whereNull('delete_at')->get();
                return view('program::fromprogrom',[
                    'items'=>$items,
                    'items2'=>$items2,
                    'items3'=>$items3,
                    'items4'=>$items4,
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/program']);
    }
    public function update($id,Request $request)
    {
        if(is_numeric($id))
        {
            $bran_id = $request->get('bran_id');
            $term_id = $request->get('term_id');
            $sub_id = $request->get('sub_id');

            if( !empty($bran_id) && !empty($term_id) && !empty($sub_id) )
            {
               /* $items = DB::table($this->table_name)
                ->where('program_id','!=',$id)
                ->whereNull('delete_at')->first();
            if(!empty($items)){
                return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้ว');
            }*/
                DB::table($this->table_name)->where('program_id',$id)->update([
                    'bran_id' =>$bran_id,
                    'term_id' =>$term_id,
                    'sub_id' =>$sub_id,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/program');
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
            $exists1 = DB::table('enrolment')
            ->where('program_id',$id)
            ->whereNull('delete_at')->first();
            if(!empty($exists1))
            {
                return MyResponse::error('ขออภัยไม่สามารถลบรายการนีได้');
            }   
            DB::table($this->table_name)->where('program_id',$id)->update([
                'delete_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}