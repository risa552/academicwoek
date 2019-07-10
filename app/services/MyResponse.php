<?php

namespace App\Services;

class MyResponse 
{
    public static function error($message){
            return [
                'status'=>400,
                'message'=>$message
            ];   
    }
    public static function success($message,$body = null){
        return [
            'status'=>200,
            'message'=>$message,
            'body'=>$body
        ];   
    }
}