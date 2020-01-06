<?php

namespace App\Modules\Home;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        $valid_file_extensions = array("jpg", "jpeg", "png", "pdf", "gif","doc","docx","xls","xlsx");
        $extension = $request->file('userfile')->getClientOriginalExtension(); // getting image extension
        $extension = strtolower($extension);
        
        if (!in_array($extension, $valid_file_extensions))
        {
            return [
                'status' => 500,
                'message'=>'ขออภัย ไฟล์ที่ท่านเลือกไม่ได้รับอนุญาตให้อัพโหลดค่ะ ค่ะ'
            ];
        }
        if($_FILES['userfile']['size'] > 10485760) // 10 mb
        {
            return [
                'status' => 500,
                'message'=>'ขออภัย อนุญาตให้ Upload ไฟล์ได้สูงสุด 10MB ค่ะ'
            ];
        }

        $dir_temp = 'uploads/';
        $filename = uniqid() . '_' . time() . '.' . $extension;
        $request->file('userfile')->move($dir_temp, $filename);
        return [
            'status' => 200,
            'url' => '/' . $dir_temp . $filename
        ];
    }

    public function exam(Request $request)
    {
        $valid_file_extensions = array("jpg", "jpeg", "png", "pdf", "gif","doc","docx","xls","xlsx");
        $extension = $request->file('userfile')->getClientOriginalExtension(); // getting image extension
        $extension = strtolower($extension);
        $program_id = $request->get('program_id');
        $term = $request->get('term');
        
        if (!in_array($extension, $valid_file_extensions))
        {
            return [
                'status' => 500,
                'message'=>'ขออภัย ไฟล์ที่ท่านเลือกไม่ได้รับอนุญาตให้อัพโหลดค่ะ ค่ะ'
            ];
        }
        if($_FILES['userfile']['size'] > 2048*1024) // 2 mb
        {
            return [
                'status' => 500,
                'message'=>'ขออภัย อนุญาตให้ Upload ไฟล์ได้สูงสุด 2MB ค่ะ'
            ];
        }

        $dir_temp = 'uploads/';
        $filename = uniqid() . '_' . time() . '.' . $extension;
        $request->file('userfile')->move($dir_temp, $filename);
        $exam= DB::table('educate')->where('educate_id',$program_id)->first();
        if(!empty($exam)){
            $sendexam= DB::table('sendexam')
            ->where('group_id',$exam->group_id)
            ->where('term_id',$exam->term_id)
            ->where('sub_id',$exam->sub_id)
            ->first();

            if(!empty($sendexam)){
                DB::table('sendexam')->where('send_id',$sendexam->send_id)->update([
                    $term=> '/' . $dir_temp . $filename,
                    'updated_at'=>date('Y-m-d')
                ]);

            }else{
                DB::table('sendexam')->insert([
                    $term => '/' . $dir_temp . $filename,
                    'created_at'=>date('Y-m-d'),
                    'group_id'=>$exam->group_id,
                    'term_id'=>$exam->term_id,
                    'sub_id'=>$exam->sub_id
                ]);
            }           
        }
        return [
            'status' => 200,
            'url' => '/' . $dir_temp . $filename
        ];
    }
}