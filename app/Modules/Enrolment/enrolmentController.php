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
        $keyword = $request->get('keyword');
        $term_id = $request->get('term_id');
        $bran_id = $request->get('bran_id');

        $terms= DB::table($this->table5)->whereNull('delete_at')->get();
        $bran= DB::table('branch')->whereNull('delete_at')->get();
        $term_current= DB::table($this->table5)
            ->where('startdate','<=',date('Y-m-d'))
            ->where('enddate','>=',date('Y-m-d'))
            ->whereNull('delete_at')->first();

            
        $items = DB::table($this->table2)
        ->select('student.*')
        // ->leftJoin('studygroup','student.group_id','studygroup.group_id')
        // ->leftJoin('branch','studygroup.bran_id','branch.bran_id')
        // ->leftJoin('enrolment','student.std_id','enrolment.std_id')
        // ->leftJoin('term','enrolment.term_id','term.term_id')
        ->whereNull('student.delete_at');
        if(!empty($keyword))
            {
                $items->where(function ($query) use($keyword){
                    $query->where('first_name','LIKE','%'.$keyword.'%')
                          ->orwhere('last_name','LIKE','%'.$keyword.'%')
                          ->orwhere('number','LIKE','%'.$keyword.'%');
                });
            }
        if(is_numeric($bran_id))
        {
            $items->whereExists(function ($query) use($bran_id) {
                $query->select(DB::raw(1))
                      ->from('studygroup')
                      ->where('studygroup.bran_id','=',$bran_id)
                      ->whereRaw('student.group_id = studygroup.group_id');
            });
        }
        if(is_numeric($term_id))
        {
            $items->whereExists(function ($query) use($term_id) {
                $query->select(DB::raw(1))
                      ->from('enrolment')
                      ->leftJoin('term','term.term_id','enrolment.term_id')
                      ->where('term.term_id','=',$term_id)
                      ->whereRaw('enrolment.std_id = student.std_id');
            });
        }
        $items=$items->orderBy('student.number','asc')->get();

        // print_r($items);exit;
        
        return view($this->table_name.'::list',compact('items','terms','term_current','bran'));
    }
    
    
}