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

        // $keyword =$request->get('keyword');
        // $std_id =$request->get('std_id');
        // $program_id =$request->get('program_id');
        // $sub_id =$request->get('sub_id');
        // $term_id =$request->get('term_id');

        // $items = DB::table($this->table_name)
        // ->select('enrolment.*',
        // 'student.first_name',
        // 'student.last_name',
        // 'program.program_id',
        // 'student.number',
        // 'subject.sub_name',
        // 'term_name')
        // ->rightJoin('student','enrolment.std_id','student.std_id')
        // ->rightJoin('subject','enrolment.sub_id','subject.sub_id')
        // ->leftJoin('program','enrolment.program_id','program.program_id')
        // ->rightJoin('term','program.term_id','term.term_id')
        // ->whereNull('enrolment.delete_at')
        // ->whereNull('term.delete_at')
        // ->whereNull('student.delete_at');

        // if(!empty($keyword))
        // {
        //     $items->where(function ($query) use($keyword){
        //         $query->where('status','LIKE','%'.$keyword.'%');
        //     });
        // }
        // if(is_numeric($std_id))
        // {
        //     $items->where('enrolment.std_id','=',$std_id);
        // }
        // if(is_numeric($program_id))
        // {
        //     $items->where('enrolment.program_id','=',$program_id);
        // }
        // if(is_numeric($sub_id))
        // {
        //     $items->where('enrolment.sub_id','=',$sub_id);
        // }
        // if(is_numeric($term_id))
        // {
        //     $items->where('enrolment.term_id','=',$term_id);
        // }
        // $items = $items->orderBy('enrolment.created_at','asc')->paginate(10);
        // $student = DB::table($this->table2)->whereNull('delete_at')->get();
        // $program = DB::table($this->table3)->whereNull('delete_at')->get();
        // $subject = DB::table($this->table4)->whereNull('delete_at')->get();
        
        return view($this->table_name.'::list',compact('items','terms','term_current','bran'));
    }
    
    
}