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
                        ->where('id',$user->user_id)
                        ->first();
                return $admin;
            }
            elseif($user->user_type===MyConst::$USER_LEVEL_TEACHER){
                $admin = DB::table('teacher')
                            ->where('id',$user->user_id)
                            ->first();
                return $admin;
            }
        }
        return null;
    }
}