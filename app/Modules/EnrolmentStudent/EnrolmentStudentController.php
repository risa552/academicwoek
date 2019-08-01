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
        $program_open = DB::table('program')
        ->select('program.*',
        'subject.sub_code',
        'subject.sub_name',
        'subject.credit',
        'subject.theory',
        'subject.practice',
        'teacher.first_name',
        'teacher.last_name')
        ->leftJoin('subject','program.sub_id','subject.sub_id')
        ->leftJoin('teacher','program.teach_id','teacher.teach_id')
        ->rightJoin('studygroup','program.bran_id','studygroup.bran_id')
        ->where('studygroup.group_id',$user->group_id)
        ->whereNull('studygroup.delete_at')
        ->whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('enrolment')
                  ->whereRaw('program.program_id = enrolment.program_id');
        })
        ->whereNull('subject.delete_at')
        ->whereNull('program.delete_at')->get();

        $program_selected = DB::table('enrolment')
        ->select('enrolment.*',
        'program.class',
        'program.room',
        'subject.sub_name',
        'subject.sub_code',
        'subject.credit',
        'subject.theory',
        'subject.practice',
        'teacher.first_name',
        'teacher.last_name')
        ->leftJoin('program','enrolment.program_id','program.program_id')
        ->leftJoin('subject','program.sub_id','subject.sub_id')
        ->leftJoin('teacher','program.teach_id','teacher.teach_id')
        ->rightJoin('studygroup','program.bran_id','studygroup.bran_id')
        ->where('studygroup.group_id',$user->group_id)
        ->whereNull('studygroup.delete_at')
        ->whereNull('subject.delete_at')
        ->whereNull('enrolment.delete_at')->get();

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
        
        return view ('enrostudent::list',compact('program_open','program_selected','history'));
    }

    public function store(Request $request)
    {
        $program_selected = $request->get('program_id');
        if(empty( $program_selected) && !is_array( $program_selected))
        {
            return MyResponse::error('กรุณาเลือกรายการวิชาที่ต้องการลงทะเบียนก่อนคะ');
        }
        $user=CurrentUser::user();
        $program_open = DB::table('program')
        ->select('program.*')
        ->rightJoin('studygroup','program.bran_id','studygroup.bran_id')
        ->where('studygroup.group_id',$user->group_id)
        ->whereNull('studygroup.delete_at')
        ->whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('enrolment')
                  ->whereRaw('program.program_id = enrolment.program_id');
        })
        ->whereNull('program.delete_at')->get();

        if(empty( $program_open) && !is_array( $program_open))
        {
            return MyResponse::error('กรุณาเลือกรายการวิชาที่ต้องการลงทะเบียนก่อนคะ');
        }
        $insert_date = [];
        foreach($program_open as $pro)
        {
            $insert_date[] = [
                'status'=> in_array($pro->program_id,$program_selected)?'ปกติ':'ถอน',
                'std_id'=>$user->std_id,
                'program_id'=>$pro->program_id,
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