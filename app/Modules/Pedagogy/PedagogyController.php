<?php

namespace App\Modules\Pedagogy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;


class PedagogyController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $term_id = $request->get('term_id');
        $teach_id = $request->get('teach_id');

        //$user=CurrentUser::user();
        $pedagogy = DB::table('educate')
        ->select('educate.*',
        'subject.sub_code',
        'subject.sub_name',
        'subject.credit',
        'subject.theory',
        'subject.practice',
        'studygroup.group_name',
        'teacher.first_name',
        'teacher.last_name')
        ->leftJoin('subject','educate.sub_id','subject.sub_id')
        ->leftJoin('teacher','educate.teach_id','teacher.teach_id')
        ->rightJoin('program','program.sub_id','subject.sub_id')
        ->rightJoin('studygroup','program.bran_id','studygroup.bran_id')

      //  ->where('teacher.teach_id',$user->teach_id)
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('term')
                  ->where('startdate','<=',date('Y-m-d'))
                  ->where('enddate','>=',date('Y-m-d'))
                  ->whereRaw('educate.term_id = term.term_id');
        })

        ->whereNull('teacher.delete_at')
        ->whereNull('subject.delete_at')
        ->whereNull('educate.delete_at');
        
        if(!empty($keyword)){
            $pedagogy->where(function ($query) use($keyword){
                $query->where('term_id','LIKE','%'.$keyword.'%');
            });
        }
        if(is_numeric($term_id))
        {
            $pedagogy->where('educate.term_id','=',$term_id);
        }
        if(is_numeric($teach_id))
        {
            $pedagogy->where('educate.teach_id','=',$teach_id);
        }
        // print_r($pedagogy);exit;
        $pedagogy = $pedagogy->get();
        $rom1 = DB::table('teacher')->whereNull('delete_at')->get();
        $rom2 = DB::table('term')->whereNull('delete_at')->get();
        return view('pedagogy::form',compact('pedagogy','rom1','rom2'));

    }
    
    public function create()
    {
        return view('pedagogy::list',compact('rom1','rom2'));
    }
    public function store(Request $request)
    {
        $first_name = $request->get('first_name');
        $last_name = $request->get('last_name');
        $sub_code = $request->get('sub_code');
        $sub_name = $request->get('sub_name');
        $credit = $request->get('credit');
        $theory = $request->get('theory');
        $practice = $request->get('practice');
        $group_id = $request->get('group_id');
        

        if( !empty($first_name) && !empty($last_name) && !empty($sub_code) && !empty($sub_name) && !empty($credit) && !empty($theory) && !empty($practice) && !empty($group_id))
        {
            $pedagogy = DB::table('educate')
            ->where('first_name',$first_name)
            ->where('last_name',$last_name)
            ->where('sub_name',$sub_name)
            ->whereNull('teacher.delete_at')->first();
            if(!empty($pedagogy))
            {
                return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้วค่ะ');
            }   
            DB::table('educate')->insertGetId([
                'first_name'=>$first_name,
                'last_name'=>$last_name,
                'sub_code'=>$sub_code,
                'sub_name'=>$sub_name,
                'credit'=>$credit,
                'theory'=>$theory,
                'practice'=>$practice,
                'group_id'=>$group_id,
                'created_at' =>date('Y-m-d H:i:s'),
                ]);
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/pedagogy');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ');
            }
        }
        public function show($educate_id,Request $request)
    {
        if(is_numeric($educate_id))
        {
            $educate = DB::table('educate')->where('educate_id',$educate_id)->first();
            if(!empty($educate))
            {
                return view('pedagogy::list',[
                    'educate'=>$educate
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/pedagogy']);
    }
    public function update($educate_id,Request $request)
    {
        if(is_numeric($educate_id))
        {
            $first_name = $request->get('first_name');
            $last_name = $request->get('last_name');
            $sub_code = $request->get('sub_code');
            $sub_name = $request->get('sub_name');
            $credit = $request->get('credit');
            $theory = $request->get('theory');
            $practice = $request->get('practice');
            $group_id = $request->get('group_id');
            
    
            if( !empty($first_name) && !empty($last_name) && !empty($sub_code) && !empty($sub_name) && !empty($credit) && !empty($theory) && !empty($practice) && !empty($group_id))
            {
                $pedagogy = DB::table('educate')
                ->where('first_name',$first_name)
                ->where('last_name',$last_name)
                ->where('sub_name',$sub_name)
                ->whereNull('delete_at')->first();
                if(!empty($pedagogy))
                {
                    return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้วค่ะ');
                }   
                DB::table('educate')->insertGetId([
                    'first_name'=>$first_name,
                    'last_name'=>$last_name,
                    'sub_code'=>$sub_code,
                    'sub_name'=>$sub_name,
                    'credit'=>$credit,
                    'theory'=>$theory,
                    'practice'=>$practice,
                    'group_id'=>$group_id,
                    'created_at' =>date('Y-m-d H:i:s'),
                ]);
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/pedagogy');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ');
            }
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
    
    public function destroy($educate_id)
    {
        if(is_numeric($educate_id))
        {   
            $exists = DB::table('educate')
            ->where('educate_id',$educate_id)
                ->whereNull('delete_at')->first();
        if(!empty($exists))
            {
                return MyResponse::error('ขออภัยไม่สามารถลบรายการนีได้');
            }   
            DB::table('educate')->where('educate_id',$educate_id)->update([
                'delete_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}
