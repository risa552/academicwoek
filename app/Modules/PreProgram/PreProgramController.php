<?php

namespace App\Modules\PreProgram;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class PreProgramController extends Controller
{
    public function index(Request $request)
    {
        $keyword =$request->get('keyword');
        $group_id = $request->get('group_id');

        $studygroup = DB::table('studygroup')
        ->whereNull('delete_at');
        if(!empty($keyword)){
            $exam->where(function ($query) use($keyword){
                $query->where('group_name','LIKE','%'.$keyword.'%');
            });
        }
        if(is_numeric($group_id)){
            $studygroup->where('studygroup.group_id','=',$group_id);
        }
        $studygroup=$studygroup->paginate(10);
        return view('preprogram::list',compact('studygroup'));

    }

    public function show($group_id,Request $request)
    {
        $group_id = $request->get('group_id');

        $items = DB::table('program')
        ->select('program.*',
        'studygroup.group_id',
        'term.term_name',
        'term.term_year',
        'subject.sub_name',
        'subject.sub_nameeng',
        'subject.sub_code',
        'subject.theory',
        'subject.practice')
        ->leftJoin('studygroup','program.group_id','studygroup.group_id')
        ->leftJoin('term','program.term_id','term.term_id')
        ->leftJoin('subject','program.sub_id','subject.sub_id')
        ->where('studygroup.group_id','=',$group_id)
        ->whereNull('program.delete_at')->paginate(10);
        

        $group_show = DB::table('studygroup')
        ->select('studygroup.group_name',
        'branch.bran_name')
        ->leftJoin('branch','studygroup.bran_id','branch.bran_id')
        ->whereNull('studygroup.delete_at')->first();

        return view('preprogram::form',compact('items','group_show'));
    }
    

    // public function report(Request $request)
    // {
    //     if(empty($group_id)){
    //         $group_id=1;
    //     }

    //     $shows = DB::table('term')
    //     ->select('term.*',
    //     'subject.sub_code',
    //     'subject.sub_name',
    //     'subject.sub_nameeng',
    //     'subject.theory',
    //     'subject.practice',
    //     'branch.bran_name')
    //     ->leftJoin('program','program.term_id','term.term_id')
    //     ->leftJoin('subject','program.sub_id','subject.sub_id')
    //     ->leftJoin('studygroup','program.group_id','studygroup.group_id')
    //     ->leftJoin('branch','branch.bran_id','studygroup.bran_id')
    //     ->whereNull('program.delete_at')
    //     ->orderBy('term.year')
    //     ->orderBy('term.term_name')
    //     ->get();

    //     $programs = [];
    //     $years = [];
    //     if(!empty($shows))
    //     {
    //         $branche = $shows[0]->bran_name;

    //         foreach($shows as $index=> $item)
    //         {
    //             if(!in_array($item->year,$years))  $years[] = $item->year;
    //             $key_term = $item->year;
    //             if(!isset($programs[$key_term][$item->term_name]))
    //             {
    //                 $programs[$key_term][$item->term_name] = [];
    //                 $programs[$key_term][$item->term_name]['name']       = $item->term_name.'/'.$item->year;
    //                 $programs[$key_term][$item->term_name]['numyear']    = count($years);
    //                 $programs[$key_term][$item->term_name]['subjects']   = [];
    //                 $programs[$key_term][$item->term_name]['subjects'][] = $item;
    //             }
    //             else
    //             {

    //                 $programs[$key_term][$item->term_name]['subjects'][] = $item;
    //             }
    //         }
    //     }
    //    // print_r($branche);exit;
    //    // $items = $items->paginate(10);
        
    //     //dd($show);
    //     return view('program::report',compact('programs','branche'));
    // }

}
?>