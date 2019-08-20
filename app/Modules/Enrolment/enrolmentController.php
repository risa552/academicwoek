<?php

namespace App\Modules\Enrolment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class EnrolmentController extends Controller
{
    private $table_name = 'enrolment';
    private $table2 = 'student';
    private $table3 = 'program';
    private $table4 = 'subject';
    private $table5 = 'term';

    public function index(Request $request)
    {
        $terms= DB::table($this->table5)->whereNull('delete_at')->get();
        $bran= DB::table('branch')->whereNull('delete_at')->get();
        $term_current= DB::table($this->table5)
            ->where('startdate','<=',date('Y-m-d'))
            ->where('enddate','>=',date('Y-m-d'))
            ->whereNull('delete_at')->first();

        $items = DB::table($this->table2)
        ->whereNull('student.delete_at')->get();

       /* $keyword =$request->get('keyword');
        $std_id =$request->get('std_id');
        $program_id =$request->get('program_id');
        $sub_id =$request->get('sub_id');
        $term_id =$request->get('term_id');

        $items = DB::table($this->table_name)
        ->select('enrolment.*',
        'student.first_name',
        'student.last_name',
        'program.program_id',
        'student.number',
        'subject.sub_name',
        'term_name')
        ->rightJoin('student','enrolment.std_id','student.std_id')
        ->rightJoin('subject','enrolment.sub_id','subject.sub_id')
        ->leftJoin('program','enrolment.program_id','program.program_id')
        ->rightJoin('term','program.term_id','term.term_id')
        ->whereNull('enrolment.delete_at')
        ->whereNull('term.delete_at')
        ->whereNull('student.delete_at');

        if(!empty($keyword))
        {
            $items->where(function ($query) use($keyword){
                $query->where('status','LIKE','%'.$keyword.'%');
            });
        }
        if(is_numeric($std_id))
        {
            $items->where('enrolment.std_id','=',$std_id);
        }
        if(is_numeric($program_id))
        {
            $items->where('enrolment.program_id','=',$program_id);
        }
        if(is_numeric($sub_id))
        {
            $items->where('enrolment.sub_id','=',$sub_id);
        }
        if(is_numeric($term_id))
        {
            $items->where('enrolment.term_id','=',$term_id);
        }
        $items = $items->orderBy('enrolment.created_at','asc')->paginate(10);
        $student = DB::table($this->table2)->whereNull('delete_at')->get();
        $program = DB::table($this->table3)->whereNull('delete_at')->get();
        $subject = DB::table($this->table4)->whereNull('delete_at')->get();*/
        
        return view($this->table_name.'::list',compact('items','terms','term_current','bran'));
    }
    
    public function create()
    {
        $student = DB::table($this->table2)->whereNull('delete_at')->get();
        $program = DB::table($this->table3)->whereNull('delete_at')->get();
        $subject = DB::table($this->table4)->whereNull('delete_at')->get();
        return view($this->table_name.'::form',compact('student','program','subject'));
    }
    
    public function store(Request $request)
    {
        $std_id = $request->get('std_id');
        $number = $request->get('number');
        $first_name = $request->get('first_name');
        $last_name = $request->get('last_name');
        $sub_id = $request->get('sub_id');
        $grade = $request->get('grade');
        $status = $request->get('status');
        $program_id = $request->get('program_id');
        if(!empty($std_id)&& !empty($first_name) && !empty($last_name) && !empty($number)  && !empty($grade) && !empty($sub_id) && !empty($status) && !empty($program_id))
        {
            $items = DB::table($this->table_name)
            ->where('program_id',$program_id)
            ->whereNull('delete_at')->first();
            if(!empty($items))
            {
                return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้ว');
            }   
            DB::table($this->table_name)->insert([
                
                'std_id'=>$std_id,
                'number'=>$number,
                'first_name'=>$first_name,
                'last_name'=>$last_name,
                'sub_id'=>$sub_id,
                'grade'=>$grade,
                'status'=>$status,
                'program_id'=>$program_id,
                'created_at' =>date('Y-m-d H:i:s'),
                //'created_at' =>date('Y-m-d H::i::s'),
            ]);
                
            return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/enrolment');
        }else{
            return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ');
        }
    }

    public function show($enro_id,Request $request)
    {
        if(is_numeric($enro_id))
        {
            $items = DB::table($this->table_name)->where('enro_id',$enro_id)->first();
            if(!empty($items))
            {
                $student = DB::table($this->table2)->whereNull('delete_at')->get();
                $program = DB::table($this->table3)->whereNull('delete_at')->get();
                $subject = DB::table($this->table4)->whereNull('delete_at')->get();
                return view($this->table_name.'::form',[
                    'items'=>$items,
                    'student'=>$student,
                    'program'=>$program,
                    'subject'=>$subject
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/enrolment']);
    }

    public function update($enro_id,Request $request)
    {
        if(is_numeric($enro_id))
        {
            $std_id = $request->get('std_id');
            $number = $request->get('number');
            $first_name = $request->get('first_name');
            $last_name = $request->get('last_name');
            $sub_id = $request->get('sub_id');
            $grade = $request->get('grade');
            $status = $request->get('status');
            $program_id = $request->get('program_id');
            
            if(!empty($std_id) && !empty($first_name) && !empty($last_name) && !empty($number) && !empty($grade) && !empty($sub_id) && !empty($status) && !empty($program_id))    
            {
                $items = DB::table($this->table_name)
            ->where('enro_id','!=',$enro_id)
            ->where('program_id',$program_id)
            ->whereNull('delete_at')->first();
            if(!empty($items)){
                return MyResponse::error('ขออภัยข้อมูลนี้มีอยู่ในระบบแล้ว');
            }
                DB::table($this->table_name)->where('enro_id',$enro_id)->update([
                   
                    'std_id'=>$std_id,
                    'number'=>$number,
                    'first_name'=>$first_name,
                    'last_name'=>$last_name,
                    'sub_id'=>$sub_id,
                    'grade'=>$grade,
                    'status'=>$status,
                    'program_id'=>$program_id,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/enrolment');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะะ');
            }
        }  
            return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }

    public function destroy($enro_id)
    {
        if(is_numeric($enro_id))
        {
            DB::table($this->table_name)->where('enro_id',$enro_id)->update([
                'delete_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}