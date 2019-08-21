<?php

namespace App\Modules\Plan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;
use App\Services\CurrentUser;


class PlanController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $sub_id = $request->get('sub_id');
        $teach_id = $request->get('teach_id');
        $term_id = $request->get('term_id');
        $bran_id = $request->get('bran_id');
       // $user=CurrentUser::user();
      
        $items = DB::table('program')
        ->select('program.*',
        'teacher.first_name',
        'teacher.last_name',
        'subject.sub_code',
        'subject.sub_name',
        'subject.theory',
        'subject.practice',
        'educate.educate_id',
        'term.term_name',
        'term.year',
        'branch.bran_name')
       
        ->leftJoin('subject','program.sub_id','subject.sub_id')
        ->leftJoin('educate','subject.sub_id','educate.sub_id')
        ->leftJoin('teacher','educate.teach_id','teacher.teach_id')
        ->leftJoin('term','program.term_id','term.term_id')
        ->leftJoin('branch','program.bran_id','branch.bran_id')
        ->where('educate.bran_id',$bran_id)
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('term')
                  ->where('startdate','<=',date('Y-m-d'))
                  ->where('enddate','>=',date('Y-m-d'))
                  ->whereRaw('program.term_id = term.term_id');
        })
        ->whereNull('program.delete_at');

        if(!empty($keyword)){
            $items->where(function ($query) use($keyword){
              
            });
        }
        if(is_numeric($sub_id))
        {
            $items->where('program.sub_id','=',$sub_id);
        }
        if(is_numeric($teach_id))
        {
            $items->where('educate.teach_id','=',$teach_id);
        }
        if(is_numeric($term_id))
        {
            $items->where('program.term_id','=',$term_id);
        }
        if(is_numeric($bran_id))
        {
            $items->where('program.bran_id','=',$bran_id);
        }
        $items = $items->orderBy('teacher.first_name')->get();
        $sub = DB::table('subject')->whereNull('delete_at')->get();
        $teacher = DB::table('teacher')->whereNull('delete_at')->get();
        $term = DB::table('term')->whereNull('delete_at')->get();
        $bran = DB::table('branch')->whereNull('delete_at')->get();
        $terms = DB::table('term')->where('term_id',$term_id)->first();

        return view('plan::list',compact('items','teacher','sub','term','terms','bran'));
    }

    public function create()
    {
        $teacher = DB::table('teacher')->whereNull('delete_at')->get();
        $subject = DB::table('subject')->whereNull('delete_at')->get();
        $studygroup = DB::table('studygroup')->whereNull('delete_at')->get();
        $term = DB::table('term')->whereNull('delete_at')->get();
        return view('educate::form',compact('teacher','subject','term','studygroup'));
    
    }

    public function store(Request $request)
    {   
            $teach_id = $request->get('teach_id');
            $sub_id = $request->get('sub_id');
            $term_id = $request->get('term_id');
            $group_id = $request->get('group_id');

            if(!empty($teach_id) && !empty($sub_id) && !empty($term_id)
            && !empty($group_id) 
            )
            { 

                DB::table('educate')->insert([
                    'teach_id' =>$teach_id,
                    'sub_id' =>$sub_id,
                    'term_id' =>$term_id,
                    'group_id' =>$group_id,
                    'created_at' =>date('Y-m-d H:i:s'),
                ]);
               return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/educate');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ'); 
            }
    }

    public function show($id,Request $request)
    {
        if(is_numeric($id))
        {
            $items = DB::table('educate')->where('educate_id',$id)->first();
            if(!empty($items))
            {
                $teacher = DB::table('teacher')->whereNull('delete_at')->get();
                $subject = DB::table('subject')->whereNull('delete_at')->get();
                $studygroup = DB::table('studygroup')->whereNull('delete_at')->get();
                $term = DB::table('term')->whereNull('delete_at')->get();
                return view('educate::form',[
                    'items'=>$items,
                    'teacher'=>$teacher,
                    'subject'=>$subject,
                    'studygroup'=>$studygroup,
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/educate']);
    }
    public function update($id,Request $request)
    {
        if(is_numeric($id))
        {
            $teach_id = $request->get('teach_id');
            $sub_id = $request->get('sub_id');
            $term_id = $request->get('term_id');
            $group_id = $request->get('group_id');

            if(!empty($teach_id) && !empty($sub_id) && !empty($term_id) 
           && !empty($group_id) 
            )
            {
               /* $items = DB::table($this->table_name)
                ->where('program_id','!=',$id)
                ->whereNull('delete_at')->first();
            if(!empty($items)){
                return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้ว');
            }*/
                DB::table('educate')->where('educate_id',$id)->update([
                    'teach_id' =>$teach_id,
                    'sub_id' =>$sub_id,
                    'term_id' =>$term_id,
                    'group_id' =>$group_id,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/educate');
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
           /* $exists1 = DB::table('enrolment')
            ->where('program_id',$id)
            ->whereNull('delete_at')->first();
            if(!empty($exists1))
            {
                return MyResponse::error('ขออภัยไม่สามารถลบรายการนีได้');
            }   */
            DB::table('educate')->where('educate_id',$id)->update([
                'delete_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}