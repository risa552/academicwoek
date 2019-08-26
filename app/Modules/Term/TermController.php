<?php

namespace App\Modules\Term;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;

class TermController extends Controller
{
    public function index(Request $request)
    {
        
        /*DB::table('term')->insert([
            'term_name' => 'เทอม',
        ]);  */
        $keyword =$request->get('keyword');
        
        $term = DB::table('term')
        ->whereNull('delete_at');
        if(!empty($keyword)){
            $term->where(function ($query) use($keyword){
                $query->where('term_name','LIKE','%'.$keyword.'%')
                      ->orwhere('year','LIKE','%'.$keyword.'%')
                      ->orwhere('startdate','LIKE','%'.$keyword.'%')
                      ->orwhere('enddate','LIKE','%'.$keyword.'%');
            });
        }
        $term = $term->paginate(10);
        return view('term::term',[
            'term'=>$term
        ]);
    }

    public function create()
    {
        return view('term::fromterm');
    
    }

    public function store(Request $request)
    {
            $term_name = $request->get('term_name');
            $year = $request->get('year');
            $startdate = $request->get('startdate');
            $enddate = $request->get('enddate');

            if(!empty($term_name) && !empty($year) && !empty($startdate) && !empty($enddate))
            {
                DB::table('term')->insert([
                    'term_name' =>$term_name,
                    'year' =>$year,
                    'startdate' =>$startdate,
                    'enddate' =>$enddate,
                    'created_at' =>date('Y-m-d H:i:s'),
                ]);
               // print_r('term');exit;
               return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/term');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ'); 
            }
        }   

    public function show($term_id,Request $request)
    {
        if(is_numeric($term_id))
        {
            $term = DB::table('term')->where('term_id',$term_id)->first();
            if(!empty($term))
            {
                return view('term::fromterm',[
                    'term'=>$term
                ]);
            }
        }
        return view('data-not-found',['back_url'=>'/term']);
    }
    public function update($term_id,Request $request)
    {
        if(is_numeric($term_id))
        {
            
            $term_name = $request->get('term_name');
            $year = $request->get('year');
            $startdate = $request->get('startdate');
            $enddate = $request->get('enddate');

            if(!empty($term_name) && !empty($year) && !empty($startdate) && !empty($enddate) )
            {
               
                DB::table('term')->where('term_id',$term_id)->update([
                    'term_name' =>$term_name,
                    'year' =>$year,
                    'startdate' =>$startdate,
                    'enddate' =>$enddate,
                    'updated_at' =>date('Y-m-d H:i:s'),
                ]);
                return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/term');
            }else{
                return MyResponse::error('กรุณาป้อนข้อมูลให้ครบด้วยค่ะ');
            }
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
    
    public function destroy($term_id)
    {
        if(is_numeric($term_id))
        {
            $exists1 = DB::table('program')
            ->where('term_id',$term_id)
            ->whereNull('delete_at')->first();
            if(!empty($exists1))
            {
                return MyResponse::error('ขออภัยไม่สามารถลบรายการนีได้');
            }   
            DB::table('term')->where('term_id',$term_id)->update([
                'delete_at' =>date('Y-m-d H:i:s'),
            ]);
            return MyResponse::success('ระบบได้ลบข้อมูลเรียบร้อยแล้ว');
        }
        return MyResponse::error('ป้อนข้อมูลไม่ถูกต้อง');
    }
}
