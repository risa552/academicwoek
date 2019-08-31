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

    public function index(Request $request)
    {
     
        $keyword =$request->get('keyword');
        $group_id =$request->get('group_id');
        $term_id =$request->get('term_id');
        $sub_id =$request->get('sub_id');

        // if(empty($)){
        //     $bran_id=1;
        // }
        $items = DB::table($this->table_name)
        ->select('program.*',
        'studygroup.group_name',
        'term.term_name',
        'term.year',
        'subject.sub_name',
        'subject.sub_code',
        'subject.theory',
        'subject.practice')
        ->leftJoin('studygroup','program.group_id','studygroup.group_id')
        ->leftJoin('term','program.term_id','term.term_id')
        ->leftJoin('subject','program.sub_id','subject.sub_id')
        ->whereNull('program.delete_at');

        if(!empty($keyword)){
            $items->where(function ($query) use($keyword){
              
            });
        }
        if(is_numeric($group_id))
        {
            $items->where('program.group_id','=',$group_id);
        }
        if(is_numeric($term_id))
        {
            $items->where('program.term_id','=',$term_id);
        }
        if(is_numeric($sub_id))
        {
            $items->where('program.sub_id','=',$sub_id);
        }
        $items = $items->get();
        // $items2 = DB::table($this->table2)->whereNull('delete_at')->get();
        // $items3 = DB::table($this->table3)->whereNull('delete_at')->get();
        // $items4 = DB::table($this->table4)->whereNull('delete_at')->get();

        $shows = DB::table('term')
        ->select('term.*',
        'subject.sub_code',
        'subject.sub_name',
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
       // print_r($branche);exit;
       // $items = $items->paginate(10);
        $items2 = DB::table($this->table2)->whereNull('delete_at')->get();
        $items3 = DB::table($this->table3)->whereNull('delete_at')->get();
        $items4 = DB::table($this->table4)->whereNull('delete_at')->get();
        //dd($show);
        return view('program::program',compact('items','items2','items3','items4','programs','branche'));
    }

    public function create()
    {
        $items2 = DB::table($this->table2)->whereNull('delete_at')->get();
        $items3 = DB::table($this->table3)->whereNull('delete_at')->get();
        $items4 = DB::table($this->table4)->whereNull('delete_at')->get();
        return view('program::fromprogrom',compact('items2','items3','items4'));
    
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
    
    public function destroy($id)
    {
        if(is_numeric($id))
        {
            $exists1 = DB::table('studygroup')
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
   /*public function  plan()
    {
        return view('program::fromprogrom');
    }*/
}