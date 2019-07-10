<?php

namespace App\Modules\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use MyConst;
use MyResponse;

class LoginController extends Controller
{
    public function index()
    {
     return view('log::login');
    }
    public function action(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');
        $remember = $request->get('remember');
        if(empty($username)){
            return MyResponse::error('กรุณาป้อนชื่อผู้ใช้ใหม่ค่ะ');
        }
        if(empty($password)){
            return MyResponse::error('กรุณาป้อน Password ค่ะ');
        }
    }
}