<?php

namespace App\Modules\DetailProgram;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class DetailProgramController extends Controller
{
    public function index(Request $request)
    {
        $keyword =$request->get('keyword');
        $sub_id =$request->get('sub_id');
        $term_id =$request->get('term_id');

        $items = DB::table('detailprogram')
        ->select('detailprogram.*',
        'subject.sub_code',
        'subject.sub_name',
        'subject.sub_name_eng',
        'term.term_name',
        'term.term_year',
        'course.cou_name',
        'year.year_name')
        ->leftJoin('subject','subject.sub_id','detailprogram.sub_id')
        ->leftJoin('term','term.term_id','detailprogram.term_id')
        ->leftJoin('program','program.program_id','detailprogram.program_id')
        ->leftJoin('course','course.cou_id','program.cou_id')
        ->leftJoin('year','year.year_id','program.year_id')
        ->whereNull('detailprogram.deleted_at');

        if(!empty($keyword))
            {
                $items->where(function ($query) use($keyword){
                    $query->where('subject.sub_code','LIKE','%'.$keyword.'%')
                        ->orwhere('subject.sub_name','LIKE','%'.$keyword.'%')
                        ->orwhere('subject.sub_name_eng','LIKE','%'.$keyword.'%');
                });
            }
            if(is_numeric($term_id))
            {
                $items->where('detailprogram.term_id','=',$term_id);
            }
            if(is_numeric($sub_id))
            {
                $items->where('detailprogram.sub_id','=',$sub_id);
            }
            $items = $items->paginate(10);
            $subject = DB::table('subject')->whereNull('deleted_at')->get();
            $term = DB::table('term')->whereNull('deleted_at')->get();
            return view ('detail::list',compact('items','subject','term'));
    }   
    public function create(Request $request)
    {

        $subgroup = DB::table('subjectgroup')->whereNull('deleted_at')->get();
        $subject = [];
        $term = DB::table('term')->whereNull('deleted_at')->get();
        $program = DB::table('program')
        ->select('program.*',
        'course.cou_name',
        'year.year_name')
        ->leftJoin('course','course.cou_id','program.cou_id')
        ->leftJoin('year','year.year_id','program.year_id')
        ->whereNull('program.deleted_at')->get();
        return view('detail::form',compact('subject','term','program','subgroup'));
    }
    public function get_subjectBygroup (Request $request)
    {
        $subgroup_id = $request->get('subgroup_id');
        $subject = DB::table('subject')
        ->select('subject.*')
        ->whereNull('subject.deleted_at')
        ->where('subject.subgroup_id',$subgroup_id)
        ->get();
        return $subject;
    }
    
    public function store(Request $request)
    {
        $sub_id = $request->get('sub_id');
        $term_id = $request->get('term_id');
        $program_id = $request->get('program_id');
       
        if( !empty($sub_id) && !empty($term_id) )
        {
            // $items = DB::table('detailprogram')
            // ->where('term.term_id',$term_id)
            // ->where('subject.sub_id',$sub_id)
            // ->whereNull('detailprogram.deleted_at')->first();
            // if(!empty($items))
            // {
            //     return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้วค่ะ');
            // }   
        
         $std_id = DB::table('detailprogram')->insertGetId([
                'term_id'=>$term_id,
                'sub_id'=>$sub_id,
                'program_id'=>$program_id,
                'created_at' =>date('Y-m-d H:i:s'),
                //'created_at' =>date('Y-m-d H::i::s'),
            ]);
            return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/detail');
        }else{
            return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ');
        }
    }

    public function show($detailpro_id,Request $request)
    {
        if(is_numeric($detailpro_id))
        {
            $items = DB::table('detailprogram')->where('detailpro_id',$detailpro_id)->first();
            if(!empty($items))
            {
                $subject_select = DB::table('subject')
                ->select('subject.*')
                ->where('sub_id',$items->sub_id)
                ->first();
                $subgroup = DB::table('subjectgroup')->whereNull('deleted_at')->get();
                $subject = DB::table('subject')
                ->select('subject.*')
                ->where('subgroup_id',$subject_select->subgroup_id)
                ->whereNull('subject.deleted_at')->get();
                $term = DB::table('term')->whereNull('deleted_at')->get();
                $program = DB::table('program')
                ->select('program.*',
                'course.cou_name',
                'year.year_name')
                ->leftJoin('course','course.cou_id','program.cou_id')
                ->leftJoin('year','year.year_id','program.year_id')
                ->whereNull('program.deleted_at')->get();
                return view('detail::form',[
                    'items'=>$items,
                    'subject'=>$subject,
                    'subgroup'=>$subgroup,
                    'term'=>$term,
                    'program'=>$program,
                    'subgroup_id'=>$subject_select->subgroup_id
                ]);
            }
            
        }
        return view('data-not-found',['back_url'=>'/detail']);
    }

    public function update($detailpro_id,Request $request)
    {
        if(is_numeric($detailpro_id))
        {
            $sub_id = $request->get('sub_id');
            $term_id = $request->get('term_id');
            $program_id = $request->get('program_id');
           
            if( !empty($sub_id) && !empty($term_id) )
        {
            // $items = DB::table('detailprogram')
            // ->where('detailpro_id','!=',$detailpro_id)
            // ->where('term.term_id',$term_id)
            // ->where('subject.sub_id',$sub_id)
            // ->whereNull('detailprogram.deleted_at')->first();
            // if(!empty($items))
            // {
            //     return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้วค่ะ');
            // }   
                DB::table('detailprogram')->where('detailpro_id',$detailpro_id)->update([
                    'term_id'=>$term_id,
                    'sub_id'=>$sub_id,
                    'program_id'=>$program_id,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/detail');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะะ');
            }
        }  
            return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }

    public function destroy($detailpro_id)
    {
        if(is_numeric($detailpro_id))
        {
            DB::table('detailprogram')->where('detailpro_id',$detailpro_id)->update([
                'deleted_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }     
    
}
