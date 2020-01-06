<?php

namespace App\Modules\DetailProgram;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;
use App\Services\PDF_Portait;


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
    
    //public function report(Request $request)
    public function report($programID, $branID)
    {
        //$program_id = $request->get('program_id');
        $program_id = $programID;
        $bran_id = $branID;
        if(empty($program_id) && empty($bran_id)){
            $program_id=1;
            $bran_id=1;
        }
        $result = $this->get_program($program_id, $bran_id);
        $programs = $result['programs'];
        $branche = $result['branche'];
        $course = $result['course'];
        $cou_name = $result['cou_name'];
        $cou_year = $result['cou_year'];
        $year_name = $result['year_name'];
        return view('detail::report',compact('programs','branche','course','cou_year','cou_name','year_name','programID','branID'));
    }
    private function get_program($program_id, $bran_id)
    {
        $shows = DB::table('detailprogram')
        ->select('detailprogram.*',
        'subject.sub_code',
        'subject.sub_name',
        'subject.sub_name_eng',
        'subject.theory',
        'subject.practice',
        'branch.bran_name',
        'year.year_name',
        'course.cou_name',
        'course.cou_year',
        'term.term_name',
        'term.term_year')
        ->leftJoin('subject','detailprogram.sub_id','subject.sub_id')
        ->leftJoin('program','detailprogram.program_id','program.program_id')
        ->leftJoin('year','program.year_id','year.year_id')
        ->leftJoin('course','program.cou_id','course.cou_id')
        ->leftJoin('branch','branch.cou_id','course.cou_id')
        ->leftJoin('term','detailprogram.term_id','term.term_id')
        // ->whereNull('detailprogram.deleted_at')
        // ->where('detailprogram.program_id',$program_id)
        // ->orWhere('program.program_id','=','detailprogram.program_id')
        ->where('detailprogram.program_id',$program_id)
        ->where('branch.bran_id', $bran_id)
        ->get();

        $programs = [];
        $years = [];
        if(!empty($shows))
        {
            $branche = $shows[0]->bran_name;
            $course = $shows[0]->cou_name;
            $cou_year = $shows[0]->cou_year;
            $cou_name = $shows[0]->cou_name;
            $year_name = $shows[0]->year_name;

            foreach($shows as $index=> $item)
            {
                if(!in_array($item->term_year,$years))  $years[] = $item->term_year;
                $key_term = $item->term_year;
                if(!isset($programs[$key_term][$item->term_name]))
                {
                    $programs[$key_term][$item->term_name] = [];
                    $programs[$key_term][$item->term_name]['name']       = $item->term_name.'/'.$item->term_year;
                    $programs[$key_term][$item->term_name]['numyear']    = count($years);
                    $programs[$key_term][$item->term_name]['subjects']   = [];
                    $programs[$key_term][$item->term_name]['subjects'][] = $item;
                }
                else
                {
                    $programs[$key_term][$item->term_name]['subjects'][] = $item;
                }
            }
        }
    //    print_r($shows);exit;
        return ['programs'=>$programs,'branche'=>$branche,'course'=>$course,'cou_year'=>$cou_year,'cou_name'=>$cou_name,'year_name'=>$year_name];
    }

    public function print_program($program_id,$bran_id)
    {
        $result = $this->get_program($program_id,$bran_id);
        $programs = $result['programs'];
        $branche = $result['branche'];
        $course = $result['course'];
        $cou_name = $result['cou_name'];
        $cou_year = $result['cou_year'];
        $year_name = $result['year_name'];
        
        $html= view('detail::report-pdf',compact('programs','branche','course','cou_name','cou_year','year_name'));
        // echo $html;exit;
        PDF_Portait::html($html->render());
    }
}
