<?php

namespace App\Modules\Home;

use Illuminate\Http\Request;
use Input;
use DB;
use App\Services\MyResponse;
use App\Services\CurrentUser;


class HomeService
{
    public static function run()
    {
        $user=CurrentUser::user();
        if(CurrentUser::is_student()) return self::student($user);
        if(CurrentUser::is_teacher()) return self::teacher($user);
        if(CurrentUser::is_admin()) return self::admin($user);
    }

    public static function student($user)
    {
        $home = DB::table('student')
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
        ->get();
        $hometeach = DB::table('teacher')
        ->leftJoin('studygroup','studygroup.teach_id','teacher.teach_id')
        ->where('studygroup.group_id',$user->group_id)        
        ->whereNull('teacher.deleted_at')
        ->get();
        return view('home::list-student',compact('home','hometeach'));
    }

    public static function teacher($user)
    {
        $home = DB::table('teacher')
        ->where('teacher.teach_id',$user->teach_id)
        ->whereNull('teacher.deleted_at')
        ->get();

        $groups = DB::table('studygroup')
        ->where('studygroup.teach_id',$user->teach_id)
        ->whereNull('studygroup.deleted_at')
        ->get();
        return view('home::list-teacher',compact('home','groups'));
    }

    public static function admin($user)
    {
        $home = DB::table('admin')
        ->where('admin.admin_id',$user->admin_id)
        ->whereNull('admin.deleted_at')
        ->get();
        return view('home::list-admin',compact('home'));

    }
}