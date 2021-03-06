<?php

namespace App\Modules\EnrolmentStudent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App\Services\MyResponse;
use App\Services\CurrentUser;

class EnrolmentStudentController extends Controller
{
    public function index()
    {
        $user=CurrentUser::user();

        $term_active = DB::table('term')
                        ->where('startdate','<=',date('Y-m-d'))
                        ->where('enddate','>=',date('Y-m-d'))
                        ->first();
        if(empty($term_active))
        {
            $term_active = DB::table('term')
                        ->orderBy('startdate','desc')
                        ->first();
        }

        $program_open = DB::select("SELECT detailprogram.*,
        subject.sub_name,subject.sub_code,subject.credit,subject.theory,subject.practice ,
        teacher.first_name,teacher.last_name
        FROM detailprogram
        LEFT JOIN subject ON(detailprogram.sub_id=subject.sub_id)
        LEFT JOIN educate ON(educate.sub_id=subject.sub_id AND educate.term_id=detailprogram.term_id)
        LEFT JOIN teacher ON(teacher.teach_id=educate.teach_id)
        WHERE detailprogram.term_id={$term_active->term_id}
        AND detailprogram.deleted_at IS NULL 
        AND educate.group_id = {$user->group_id}
        AND subject.deleted_at IS NULL
        AND NOT EXISTS(SELECT 1 FROM enrolment xx WHERE xx.sub_id=detailprogram.sub_id and xx.term_id=detailprogram.term_id AND xx.std_id={$user->std_id} )");
        
        
    // print_r($program_open);exit;

        $program_selected = DB::select("SELECT detailprogram.*,
        subject.sub_name,subject.sub_code,subject.credit,subject.theory,subject.practice ,
        teacher.first_name,teacher.last_name,enrolment.std_id
        FROM detailprogram
        RIGHT JOIN enrolment ON(enrolment.sub_id=detailprogram.sub_id AND enrolment.term_id=detailprogram.term_id )
        LEFT JOIN subject ON(enrolment.sub_id=subject.sub_id)
        LEFT JOIN educate ON(educate.sub_id=enrolment.sub_id AND educate.term_id=enrolment.term_id)
        LEFT JOIN teacher ON(teacher.teach_id=educate.teach_id)
        WHERE detailprogram.term_id={$term_active->term_id} 
        AND detailprogram.deleted_at IS NULL 
        -- AND program.group_id = {$user->group_id}
        -- AND program.group_id = {$user->group_id}
        AND enrolment.std_id = {$user->std_id}
        AND educate.group_id = {$user->group_id}
        AND subject.deleted_at IS NULL
        ");
        // print_r($program_selected);exit;

        $history = DB::table('student')
        ->select('student.first_name',
        'student.last_name',
        'student.number',
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
        //print_r($history);exit;
        return view ('enrostudent::list',compact('program_open','program_selected','history'));
    }

    public function store(Request $request)
    {
        $subject_id = $request->get('subject_id');
        if(empty( $subject_id) && !is_array( $subject_id))
        {
            return MyResponse::error('กรุณาเลือกรายการวิชาที่ต้องการลงทะเบียนก่อนคะ');
        }

        $user=CurrentUser::user();

        $term_active = DB::table('term')
                        ->where('startdate','<=',date('Y-m-d'))
                        ->where('enddate','>=',date('Y-m-d'))
                        ->first();
        if(empty($term_active))
        {
            $term_active = DB::table('term')
                        ->orderBy('startdate','desc')
                        ->first();
        }

        $program_open = DB::select("SELECT detailprogram.*,
        subject.sub_name,subject.sub_code,subject.credit,subject.theory,subject.practice ,
        teacher.first_name,teacher.last_name
        FROM detailprogram
        LEFT JOIN subject ON(detailprogram.sub_id=subject.sub_id)
        LEFT JOIN educate ON(educate.sub_id=subject.sub_id AND educate.term_id=detailprogram.term_id)
        LEFT JOIN teacher ON(teacher.teach_id=educate.teach_id)
        WHERE detailprogram.term_id={$term_active->term_id}
        AND detailprogram.deleted_at IS NULL 
        AND educate.group_id = {$user->group_id}
        AND subject.deleted_at IS NULL
        AND NOT EXISTS(SELECT 1 FROM enrolment xx WHERE xx.sub_id=detailprogram.sub_id and xx.term_id=detailprogram.term_id AND xx.std_id={$user->std_id} )");

        if(empty( $program_open) && !is_array( $program_open))
        {
            return MyResponse::error('กรุณาเลือกรายการวิชาที่ต้องการลงทะเบียนก่อนคะ');
        }
        $insert_date = [];
        foreach($program_open as $pro)
        {
            $insert_date[] = [
                'status'=> in_array($pro->sub_id,$subject_id)?'ปกติ':'ถอน',
                'std_id'=>$user->std_id,
                'sub_id'=>$pro->sub_id,
                'term_id'=>$pro->term_id,
                'created_at'=>date('Y-m-d H:i:s'),
            ];
        }
        if(!empty($insert_date))
        {
            DB::table('enrolment')->insert($insert_date);
            return MyResponse::success('ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว','/enrostudent');
        }
        return MyResponse::error('ไม่สามารถบันทึกข้อมูลได้');
    }
}
?>