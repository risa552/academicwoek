<?php

namespace App\Modules\Educate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;
use App\Services\PDF_Landscape;

class EducateController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $term_id = $request->get('term_id');
        $group_id = $request->get('group_id');

        $items = DB::table('term')
        ->select('term.term_id',
        'term.term_name',
        'term.term_year',
        'studygroup.group_id',
        'studygroup.group_name',
        'detailprogram.detailpro_id')
        ->leftjoin('detailprogram','detailprogram.term_id','term.term_id')
        ->leftjoin('studygroup','detailprogram.program_id','studygroup.program_id')
        ->whereNotNull('studygroup.group_name')
        ->get();
      
        $terms = DB::table('term')->whereNull('deleted_at')->get();
        $groups = DB::table('studygroup')->whereNull('deleted_at')->get();
   // dd($items);
        return view('educate::list',compact('items','terms','groups'));
    }

    public function index2(Request $request)
    {
        // $keyword = $request->get('keyword');
        // $sub_id = $request->get('sub_id');
        // $teach_id = $request->get('teach_id');
        $term_id = $request->get('term_id');
        $group_id = $request->get('group_id');
        // if(empty($group_id)){
        //     $group_id=1;
        // }
      
        $items = DB::table('detailprogram')
        ->select('detailprogram.*',
        'teacher.first_name',
        'teacher.last_name',
        'subject.sub_code',
        'subject.sub_name',
        'subject.sub_name_eng',
        'subject.theory',
        'subject.practice',
        'term.term_name',
        'term.term_year',
        'studygroup.group_name',
        'studygroup.group_id')
        ->leftJoin('subject','detailprogram.sub_id','subject.sub_id')
        ->leftJoin('program','detailprogram.program_id','program.program_id')
        ->leftJoin('studygroup','program.program_id','studygroup.program_id')
        ->leftJoin('teacher','teacher.teach_id','studygroup.teach_id')
        ->leftJoin('term','detailprogram.term_id','term.term_id')
        ->where('term.term_id',$term_id)
        ->where('studygroup.group_id',$group_id)
        
        ->whereNull('detailprogram.deleted_at');

        
        $items = $items->paginate(50);
       // print_r($items);exit;

        $temp_educations = DB::table('educate')
            ->select(
            'educate_id',
            'sub_id',
            'term_id',
            'group_id',
            'educate.teach_id',
            'teacher.first_name',
            'teacher.last_name'
            )
            ->leftJoin('teacher','educate.teach_id','teacher.teach_id')
            ->get();
        $educations = [];
        foreach($temp_educations as $edu)
        {
            $key = $edu->sub_id.'-'.$edu->term_id.'-'.$edu->group_id;
            $educations[$key] = $edu;
        }
        $temp_items = [];
        foreach($items as $item)
        {
            $key = $item->sub_id.'-'.$item->term_id.'-'.$item->group_id;
            $item->educate_id=null;
            $item->teach_id=null;
            $item->first_name='';
            $item->last_name='';
            if(isset($educations[$key]))
            {
                $o = $educations[$key];
                $item->educate_id=$o->educate_id;
                $item->teach_id=$o->teach_id;
                $item->first_name=$o->first_name;
                $item->last_name=$o->last_name;
            }
            $temp_items[] = $item;
        }
        $items = $temp_items;
        // ส่วนตารางรายงาน
        $list = DB::table('detailprogram')
        ->select('detailprogram.*',
        'teacher.first_name',
        'teacher.last_name',
        'studygroup.group_name',
        'studygroup.group_type',
        'subject.sub_code',
        'subject.sub_name',
        'subject.sub_name_eng',
        'subject.theory',
        'subject.practice',
        'term.term_name',
        'term.term_year',
        'degree.degree_name')
        ->leftjoin('term','detailprogram.term_id','term.term_id')
        ->leftjoin('subject','detailprogram.sub_id','subject.sub_id')
        ->leftjoin('educate','educate.sub_id','subject.sub_id')
        ->leftJoin('program','detailprogram.program_id','program.program_id')

        ->leftjoin('teacher','educate.teach_id','teacher.teach_id')
        ->leftjoin('studygroup','program.program_id','studygroup.program_id')
        ->leftjoin('degree','studygroup.degree_id','degree.degree_id')
       
        ->whereNull('detailprogram.deleted_at')
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('term')
                  ->where('startdate','<=',date('Y-m-d'))
                  ->where('enddate','>=',date('Y-m-d'))
                  ->whereRaw('detailprogram.term_id = term.term_id');
        })
        ->get();
        //print_r($list);exit;
        $sub = DB::table('subject')->whereNull('deleted_at')->get();
        $teachers = DB::table('teacher')->whereNull('deleted_at')->get();
        $terms = DB::table('term')->whereNull('deleted_at')->get();
        $groups = DB::table('studygroup')->whereNull('deleted_at')->get();
   // dd($items);
        return view('educate::educate-teach',compact('items','teachers','sub','terms','groups','list'));
    }

    public function create()
    {
        $teachers = DB::table('teacher')->whereNull('deleted_at')->get();
        $sub = DB::table('subject')->whereNull('deleted_at')->get();
        $group = DB::table('studygroup')->whereNull('deleted_at')->get();
        $term = DB::table('term')->whereNull('deleted_at')->get();
        return view('educate::form',compact('teachers','sub','term','group'));
    }

    public function store(Request $request)
    {   
        $teach_id = $request->get('teach_id');
        $sub_id = $request->get('sub_id');
        $term_id = $request->get('term_id');
        $group_id = $request->get('group_id');

        if(!empty($teach_id) && !empty($sub_id) && !empty($term_id) && !empty($group_id))
        { 
            DB::table('educate')->insertGetid([
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
        $term_id = $request->get('term_id');
        $group_id = $request->get('group_id');
        if(is_numeric($id))
        { 
            $item = DB::table('detailprogram')
            ->select('detailprogram.*',
            'subject.sub_id',
            'subject.sub_code',
            'subject.sub_name',
            'term.term_id',
            'term.term_name',
            'term.term_year',
            'studygroup.group_id',
            'studygroup.group_name')
           
            ->leftJoin('program','detailprogram.program_id','program.program_id')
            ->leftJoin('subject','detailprogram.sub_id','subject.sub_id')
            ->leftJoin('studygroup','program.program_id','studygroup.program_id')
            ->leftJoin('term','detailprogram.term_id','term.term_id')
            ->where('term.term_id',$term_id)
            ->where('studygroup.group_id',$group_id)
            ->where('detailprogram.detailpro_id',$id)->first();
            if(!empty($item)){
                $teacher = DB::table('educate')
                ->select('teach_id','educate_id')
                ->where('sub_id',$item->sub_id)
                ->where('term_id',$item->term_id)
                ->where('group_id',$item->group_id)
                ->whereNull('deleted_at')->first();
                //dd($teacher);
                $teachers = DB::table('teacher')->whereNull('deleted_at')->get();
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
            $group_id = $request->get('group_id');

            if(!empty($teach_id) && !empty($sub_id) && !empty($term_id) && !empty($group_id) )
            {
               /* $items = DB::table($this->table_name)
                ->where('program_id','!=',$id)
                ->whereNull('deleted_at')->first();
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
            ->whereNull('deleted_at')->first();
            if(!empty($exists1))
            {
                return MyResponse::error('ขออภัยไม่สามารถลบรายการนีได้');
            }   */
            DB::table('educate')->where('educate_id',$id)->update([
                'deleted_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
    public function report(Request $request)
    {
        
        if(empty($group_id)){
            $group_id=1;
        }
        $result = $this->get_educate();
        $teachers = $result['teachers'];
        $sub = $result['sub'];
        $term = $result['term'];
        $group = $result['group'];
        $items = $result['items'];
        $terms = $result['terms'];
        
        return view('educate::report',compact('teachers','sub','term','group','items','terms'));
    }
    private function get_educate()
    {
        $lists = DB::table('detailprogram')
        ->select('detailprogram.*',
        'teacher.teach_id',
        'teacher.first_name',
        'teacher.last_name',
        'studygroup.group_name',
        'studygroup.group_type',
        'subject.sub_code',
        'subject.sub_name',
        'subject.sub_name_eng',
        'subject.theory',
        'subject.practice',
        'term.term_name',
        'term.term_year',
        'degree.degree_name')
        ->leftjoin('term','detailprogram.term_id','term.term_id')
        ->leftjoin('subject','detailprogram.sub_id','subject.sub_id')
        ->leftjoin('educate','educate.sub_id','subject.sub_id')
        ->leftjoin('program','detailprogram.program_id','program.program_id')
        ->leftjoin('teacher','educate.teach_id','teacher.teach_id')
        ->leftjoin('studygroup','educate.group_id','studygroup.group_id')
        ->leftjoin('degree','studygroup.degree_id','degree.degree_id')
       
        ->whereNull('detailprogram.deleted_at')
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('term')
                  ->where('startdate','<=',date('Y-m-d'))
                  ->where('enddate','>=',date('Y-m-d'))
                  ->whereRaw('detailprogram.term_id = term.term_id');
        })
        ->get();

        $items=[];
        foreach($lists as $list){
            $theory=!is_numeric($list->theory)?0:$list->theory;
            $practice=!is_numeric($list->practice)?0:$list->practice;
            if(!isset($items[$list->teach_id])){
                $items[$list->teach_id]=[
                    'items'=>[],

                ];
                $items[$list->teach_id]['items'][] = [
                    'name'=>$list->first_name,
                    'surname'=>$list->last_name,
                    'sub_code'=>$list->sub_code,
                    'sub_name'=>$list->sub_name,
                    'sub_name_eng'=>$list->sub_name_eng,
                    'degree_1'=>($list->degree_name == 'ปวส.')?$list->group_name:'',
                    'degree_2'=>($list->degree_name != 'ปวส.')?$list->group_name:'',
                    'C1'=>($list->group_type == 'ปกติ')?$list->theory:'',
                    'C2'=>($list->group_type == 'ปกติ')?$list->practice:'',
                    'C3'=>($list->group_type == 'ปกติ' && $list->degree_name == 'ปวส.')?($practice+$theory):'',
                    'C4'=>($list->group_type == 'ปกติ' && $list->degree_name != 'ปวส.')?($practice+$theory):'',
                    'C5'=>($list->group_type != 'ปกติ')?$list->theory:'',
                    'C6'=>($list->group_type != 'ปกติ')?$list->practice:'',
                    'C7'=>($list->group_type != 'ปกติ' && $list->degree_name != 'ปวส.')?($practice+$theory):'',
                    'C8'=>($list->group_type == 'ปกติ')?($practice+$theory):'',
                    'C9'=>($list->group_type != 'ปกติ')?($practice+$theory):'',
                    'C10'=>($practice+$theory)
                ];
            }else{
                $items[$list->teach_id]['items'][] = [
                    'name'=>"",
                    'surname'=>"",
                    'sub_code'=>$list->sub_code,
                    'sub_name'=>$list->sub_name,
                    'sub_name_eng'=>$list->sub_name_eng,
                    'degree_1'=>($list->degree_name == 'ปวส.')?$list->group_name:'',
                    'degree_2'=>($list->degree_name != 'ปวส.')?$list->group_name:'',
                    'C1'=>($list->group_type == 'ปกติ')?$list->theory:'',
                    'C2'=>($list->group_type == 'ปกติ')?$list->practice:'',
                    'C3'=>($list->group_type == 'ปกติ' && $list->degree_name == 'ปวส.')?($practice+$theory):'',
                    'C4'=>($list->group_type == 'ปกติ' && $list->degree_name != 'ปวส.')?($practice+$theory):'',
                    'C5'=>($list->group_type != 'ปกติ')?$list->theory:'',
                    'C6'=>($list->group_type != 'ปกติ')?$list->practice:'',
                    'C7'=>($list->group_type != 'ปกติ' && $list->degree_name != 'ปวส.')?($practice+$theory):'',
                    'C8'=>($list->group_type == 'ปกติ')?($practice+$theory):'',
                    'C9'=>($list->group_type != 'ปกติ')?($practice+$theory):'',
                    'C10'=>($practice+$theory)
                ];
            }
        }
        $items = array_values($items);
        $terms = DB::table('term')
        ->select('term.*')->first();
        // dd(DB::getQueryLog());
        // print_r($items);exit;
        $sub = DB::table('subject')->whereNull('deleted_at')->get();
        $teachers = DB::table('teacher')->whereNull('deleted_at')->get();
        $term = DB::table('term')->whereNull('deleted_at')->get();
        $group = DB::table('studygroup')->whereNull('deleted_at')->get();

        return ['teachers'=>$teachers,'sub'=>$sub,'term'=>$term,'group'=>$group,'items'=>$items,'terms'=>$terms];
    }
    public function print_educate()
    {
        $result = $this->get_educate();
        $teachers = $result['teachers'];
        $sub = $result['sub'];
        $term = $result['term'];
        $group = $result['group'];
        $items = $result['items'];
        $terms = $result['terms'];
        
        $html= view('educate::report-pdf',compact('teachers','sub','term','group','items','terms'));
        // echo $html;exit;
        PDF_Landscape::html($html->render());
    }
}