<?php

namespace App\Modules\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;

class GroupController extends Controller
{
    public function index()
    {
     return view('group::Group');
    }
}