<?php

namespace App\Services;

class MyResponse 
{
    public static function error($message){
            return response()->json([
                'status'=>400,
                'message'=>$message
            ],400);   
    }
    public static function success($message,$url='',$body = null){
        return [
            'status'=>200,
            'url' =>$url,
            'message'=>$message,
            'body'=>$body
        ];   
    }
}