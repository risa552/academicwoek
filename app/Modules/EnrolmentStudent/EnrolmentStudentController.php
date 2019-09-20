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

        $program_open = DB::select("SELECT program.*,
        subject.sub_name,subject.sub_code,subject.credit,subject.theory,subject.practice ,
        teacher.first_name,teacher.last_name
        FROM program
        LEFT JOIN subject ON(program.sub_id=subject.sub_id)
        -- LEFT JOIN enrolment ON(enrolment.sub_id=subject.sub_id)
        -- LEFT JOIN student ON(enrolment.std_id=student.std_id)
        LEFT JOIN educate ON(educate.sub_id=subject.sub_id AND educate.term_id=program.term_id)
        LEFT JOIN teacher ON(teacher.teach_id=educate.teach_id)
        WHERE program.term_id={$term_active->term_id} 
        AND program.delete_at IS NULL 
        AND program.group_id = {$user->group_id}
        AND subject.delete_at IS NULL
        AND NOT EXISTS(SELECT 1 FROM enrolment xx WHERE xx.sub_id=program.sub_id and xx.term_id=program.term_id AND xx.std_id={$user->std_id})
        ");


        $program_selected = DB::select("SELECT program.*,
        subject.sub_name,subject.sub_code,subject.credit,subject.theory,subject.practice ,
        teacher.first_name,teacher.last_name,enrolment.std_id
        FROM program
        RIGHT JOIN enrolment ON(enrolment.sub_id=program.sub_id AND enrolment.term_id=program.term_id )
        LEFT JOIN subject ON(program.sub_id=subject.sub_id)
        LEFT JOIN educate ON(educate.sub_id=subject.sub_id AND educate.term_id=program.term_id)
        LEFT JOIN teacher ON(teacher.teach_id=educate.teach_id)
        WHERE program.term_id={$term_active->term_id} 
        AND program.delete_at IS NULL 
        AND program.group_id = {$user->group_id}
        AND enrolment.std_id = {$user->std_id}
        AND subject.delete_at IS NULL
        ");

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
        ->whereNull('studygroup.delete_at')
        ->whereNull('branch.delete_at')
        ->whereNull('degree.delete_at')
        ->whereNull('course.delete_at')
        ->whereNull('student.delete_at')->get();
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

        $program_open = DB::select("SELECT program.*,
        subject.sub_name,subject.sub_code,subject.credit,subject.theory,subject.practice ,
        teacher.first_name,teacher.last_name
        FROM program
        LEFT JOIN subject ON(program.sub_id=subject.sub_id)
        LEFT JOIN educate ON(educate.sub_id=subject.sub_id AND educate.term_id=program.term_id)
        LEFT JOIN teacher ON(teacher.teach_id=educate.teach_id)
        WHERE program.term_id={$term_active->term_id} 
        AND program.delete_at IS NULL 
        AND program.group_id = {$user->group_id}
        AND subject.delete_at IS NULL
        AND NOT EXISTS(SELECT 1 FROM enrolment xx WHERE xx.sub_id=program.sub_id and xx.term_id=program.term_id)
        ");


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