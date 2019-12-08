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
        ->whereNull('studygroup.deleted_at')
        ->whereNull('branch.deleted_at')
        ->whereNull('degree.deleted_at')
        ->whereNull('course.deleted_at')
        ->whereNull('student.deleted_at')->get();

        return view('history::list',compact('history'));
    }

  
}