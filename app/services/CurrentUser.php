<?php

namespace App\Services;
use Auth;
use DB;
use MyConst;


class CurrentUser
{
    public static function user(){
        if(Auth::check()){
            $user = Auth::user();
            if($user->user_type===MyConst::$USER_LEVEL_ADMIN){
                $admin = DB::table('admin')
                        ->where('admin_id',$user->user_id)
                        ->first();
                return $admin;
            }
            elseif($user->user_type===MyConst::$USER_LEVEL_TEACHER){
                $admin = DB::table('teacher')
                            ->where('teach_id',$user->user_id)
                            ->first();
                return $admin;
            }
            elseif($user->user_type===MyConst::$USER_LEVEL_STUDENT){
                $admin = DB::table('student')
                            ->where('std_id',$user->user_id)
                            ->first();
                return $admin;
            }
        }
        return null;
    }
    public static function menu(){
        if(Auth::check()){
            $user = Auth::user();
            if($user->user_type===MyConst::$USER_LEVEL_ADMIN){
                return view('menu-admin');
            }
            elseif($user->user_type===MyConst::$USER_LEVEL_TEACHER){
                return view('menu-professor');
            }
            elseif($user->user_type===MyConst::$USER_LEVEL_STUDENT){
                return view('menu-student');
            }
        }
        return '';
    }
}