<?php

namespace App\Modules\History;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;
use App\Services\CurrentUser;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $user=CurrentUser::user();
        $history = DB::table('student')
        ->select('student.*',
        'course.cou_name',
        'branch.bran_name',
        'studygroup.group_name',
        'degree.degree_name')
        ->leftJoin('studygroup','student.group_id','studygroup.group_id')
        ->rightJoin('branch','studygroup.bran_id','branch.bran_id')
        ->rightJoin('degree','studygroup.degree_id','degree.degree_id')
        ->rightJoin('course','branch.cou_id','course.cou_id')
        ->where('student.std_id',$user->std_id)
        ->whereNull('studygroup.delete_at')
        ->whereNull('branch.delete_at')
        ->whereNull('degree.delete_at')
        ->whereNull('course.delete_at')
        ->whereNull('student.delete_at')->get();

        return view('history::list',compact('history'));
    }

  
}