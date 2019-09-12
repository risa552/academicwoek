<?php

namespace App\Modules\Program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class ProgramController extends Controller
{
    private $table_name = 'program';
    private $table2 = 'studygroup';
    private $table3 = 'term';
    private $table4 = 'subject';

    public function show($group_id,Request $request)
    {

        $items = DB::table($this->table_name)
        ->select('program.*',
        'studygroup.group_name',
        'term.term_name',
        'term.year',
        'subject.sub_name',
        'subject.sub_nameeng',
        'subject.sub_code',
        'subject.theory',
        'subject.practice')
        ->leftJoin('studygroup','program.group_id','studygroup.group_id')
        ->leftJoin('term','program.term_id','term.term_id')
        ->leftJoin('subject','program.sub_id','subject.sub_id')
        ->where('program.group_id',$group_id)
        ->OrderBy('term.term_name','asc')
        ->OrderBy('term.year','asc')
        ->whereNull('program.delete_at');

        $items = $items->get();
        $items2 = DB::table($this->table2)->whereNull('delete_at')->get();
        $items3 = DB::table($this->table3)->whereNull('delete_at')->get();
        $items4 = DB::table($this->table4)->whereNull('delete_at')->get();

        $group_show = DB::table('studygroup')
        ->select('studygroup.*',
        'branch.bran_name')
        ->leftJoin('branch','studygroup.bran_id','branch.bran_id')
        ->where('studygroup.group_id',$group_id)
        ->whereNull('studygroup.delete_at')->first();
        
        return view('program::program',compact('items','items2','items3','items4','group_show'));
    }

    public function create(Request $request)
    {
        $group_id = $request->get('group_id');

        if(is_numeric($group_id))
        {
            $group = DB::table('studygroup')
            ->where('group_id',$group_id)->first();
            if(!empty($group))
            {
                $terms = DB::table($this->table3)->whereNull('delete_at')->get();
                $subjects = DB::table($this->table4)->whereNull('delete_at')->get();
                return view('program::fromprogrom',[
                    'terms'=>$terms,
                    'subjects'=>$subjects,
                    'group_id'=>$group_id,
                    'group_name'=>$group->group_name,
                    'action'=>'/program',
                    'method'=>'post'
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/program']);
    }

    public function store(Request $request)
    {   
            $group_id = $request->get('group_id');
            $term_id = $request->get('term_id');
            $sub_id = $request->get('sub_id');

            if(!empty($group_id) && !empty($term_id) && !empty($sub_id) )
            { 
                DB::table($this->table_name)->insert([
                    'group_id' =>$group_id,
                    'term_id' =>$term_id,
                    'sub_id' =>$sub_id,
                    'created_at' =>date('Y-m-d H:i:s'),
                ]);
               return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/program/'.$group_id);
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ'); 
            }
    }

    public function showw($id,Request $request)
    {
        if(is_numeric($id))
        {
            $program = DB::table($this->table_name)
            ->select('program.*',
            'studygroup.group_id',
            'studygroup.group_name')
            ->leftJoin('studygroup','studygroup.group_id','program.group_id')
            ->where('program_id',$id)->first();
            if(!empty($program))
            { 
                $group_id = $program->group_id;
                $group_name = $program->group_name;
                $terms = DB::table($this->table3)->whereNull('delete_at')->get();
                $subjects = DB::table($this->table4)->whereNull('delete_at')->get();
                return view('program::fromprogrom',[
                    'program'=>$program,
                    'terms'=>$terms,
                    'subjects'=>$subjects,
                    'group_id'=>$group_id,
                    'group_name'=>$group_name,
                    'action'=>'/program/'.$id,
                    'method'=>'put'
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/program']);
    }
    public function update($id,Request $request)
    {
        if(is_numeric($id))
        {
            $group_id = $request->get('group_id');
            $term_id = $request->get('term_id');
            $sub_id = $request->get('sub_id');

            if( !empty($group_id) && !empty($term_id) && !empty($sub_id) )
            {
               /* $items = DB::table($this->table_name)
                ->where('program_id','!=',$id)
                ->whereNull('delete_at')->first();
            if(!empty($items)){
                return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้ว');
            }*/
                DB::table($this->table_name)->where('program_id',$id)->update([
                    'group_id' =>$group_id,
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
    
    public function destroy($program_id)
    {
        
            DB::table($this->table_name)->where('program_id',$program_id)->update([
                'delete_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        
        // return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
   /*public function  plan()
    {
        return view('program::fromprogrom');
    }*/
    public function report(Request $request)
    {
        if(empty($group_id)){
            $group_id=1;
        }

        $shows = DB::table('term')
        ->select('term.*',
        'subject.sub_code',
        'subject.sub_name',
        'subject.sub_nameeng',
        'subject.theory',
        'subject.practice',
        'branch.bran_name')
        ->leftJoin('program','program.term_id','term.term_id')
        ->leftJoin('subject','program.sub_id','subject.sub_id')
        ->leftJoin('studygroup','program.group_id','studygroup.group_id')
        ->leftJoin('branch','branch.bran_id','studygroup.bran_id')
        ->whereNull('program.delete_at')
        ->orderBy('term.year')
        ->orderBy('term.term_name')
        ->get();
       // print_r($bran_id);exit;

        $programs = [];
        $years = [];
        if(!empty($shows))
        {
            $branche = $shows[0]->bran_name;

            foreach($shows as $index=> $item)
            {
                if(!in_array($item->year,$years))  $years[] = $item->year;
                $key_term = $item->year;
                if(!isset($programs[$key_term][$item->term_name]))
                {
                    $programs[$key_term][$item->term_name] = [];
                    $programs[$key_term][$item->term_name]['name']       = $item->term_name.'/'.$item->year;
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
        //print_r($programs);exit;
       // $items = $items->paginate(10);
        
        //dd($show);
        return view('program::report',compact('programs','branche'));
    }

}