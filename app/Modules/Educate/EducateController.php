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
        $sub_id = $request->get('sub_id');
        $teach_id = $request->get('teach_id');
        $term_id = $request->get('term_id');
        $bran_id = $request->get('bran_id');
      
        $items = DB::table('program')
        ->select('program.*',
        'teacher.first_name',
        'teacher.last_name',
        'subject.sub_code',
        'subject.sub_name',
        'educate.educate_id',
        'branch.bran_name',
        'term.term_name',
        'term.year')
       
        ->leftJoin('subject','program.sub_id','subject.sub_id')
        ->leftJoin('educate','subject.sub_id','educate.sub_id')
        ->leftJoin('teacher','educate.teach_id','teacher.teach_id')
        ->leftJoin('branch','program.bran_id','branch.bran_id')
        ->leftJoin('term','program.term_id','term.term_id')

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
       
        return view('educate::list',compact('items','teacher','sub','term','bran'));
    }

    public function create()
    {
        $teacher = DB::table('teacher')->whereNull('delete_at')->get();
        $sub = DB::table('subject')->whereNull('delete_at')->get();
        $term = DB::table('term')->whereNull('delete_at')->get();
        return view('educate::form',compact('teacher','sub','term'));
    }

    public function store(Request $request)
    {   
        $teach_id = $request->get('teach_id');
        $sub_id = $request->get('sub_id');
        $term_id = $request->get('term_id');

        if(!empty($teach_id) && !empty($sub_id) && !empty($term_id))
        { 
            DB::table('educate')->insertGetid([
                'teach_id' =>$teach_id,
                'sub_id' =>$sub_id,
                'term_id' =>$term_id,
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
            $item = DB::table('program')
            ->select('program.*',
            'subject.sub_id',
            'subject.sub_code',
            'subject.sub_name',
            'term.term_id',
            'term.term_name',
            'term.year')
           
            ->leftJoin('subject','program.sub_id','subject.sub_id')
            ->leftJoin('term','program.term_id','term.term_id')
            ->where('startdate','<=',date('Y-m-d'))
            ->where('enddate','>=',date('Y-m-d'))
            ->where('program.program_id',$id)->first();
            if(!empty($item)){
                $teacher = DB::table('educate')
                ->select('teach_id','educate_id')
                ->where('sub_id',$item->sub_id)
                ->where('term_id',$item->term_id)
                ->whereNull('delete_at')->first();

                $teachers = DB::table('teacher')->whereNull('delete_at')->get();
                return view('educate::form',[
                    'item'=>$item,
                    'teacher'=>$teacher,
                    'teachers'=>$teachers,
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

            if(!empty($teach_id) && !empty($sub_id) && !empty($term_id) )
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