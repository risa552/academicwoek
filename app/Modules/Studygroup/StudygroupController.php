<?php

namespace App\Modules\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class GroupController extends Controller
{
    public function index(Request $request)
    {
    return view('group::Group');
    }
    public function fromgroup()
    {
    return view('group::fromgroup');
    }
    public function editgroup()
    {
    return view('group::editgroup');
    }
}