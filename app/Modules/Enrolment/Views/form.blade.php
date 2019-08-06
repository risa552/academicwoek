@extends('academic-layout') 
@section('title','ข้อมูลลงทะเบียน')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">  
            <a herf="/enrolment" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                    @if(isset($student))
                    ข้อมูลลงทะเบียน : {{$student[0]->number}}
                    @else
                    เพิ่มข้อมูลลงทะเบียน
                    @endif
                    </div>
                    @if(isset($items))
                    <form action="/enrolment/{{$items->enro_id}}" class="form-ajax" method="put">
                        <input type="hidden" value="put" name="_mathods">
                        @csrf()
                    @else
                    <form class="form-ajax" action="/enrolment" method="POST">
                    @csrf()
                    @endif
                    <div class="panel-body">
                            <div>
                                <label >รหัสนักศึกษา:</label>
                                <input type="text" readonly name="number" class="form-control" value="{{isset($student)?$student[0]->number:''}}"/> 
                            </div>
                            <div>
                                <label >ชื่อนักศึกษา:</label>
                                <select name="std_id">
                                    <option value="all">
                                        ทั้งหมด
                                    </option>
                                @foreach($student as $index => $row1)
                                    <option value ="{{$row1->std_id}}" {{Input::get('std_id')==$row1->std_id?'stlected':''}}>
                                        {{$row1->first_name}} {{$row1->last_name}}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                            <div>
                                <label >วิชา:</label>
                                <select name="sub_id">
                                    <option value="all">
                                        ทั้งหมด
                                    </option>
                                @foreach($subject as $index => $row3)
                                    <option value ="{{$row3->sub_id}}" {{Input::get('sub_id')==$row3->sub_id?'stlected':''}}>
                                        {{$row3->sub_name}}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                            <div class="panel-body">
                            <div>
                                <label >เกรด:</label>
                                <input type="text" name="grade" class="form-control" value="{{isset($items)?$items->grade:''}}"/> 
                            </div>
                            <div>
                                <label >สถานะ:</label>
                                <select  name="status" class="form-control">
                                    <option {{isset($items) && $items->status=='ปกติ'?' selected ':''}} value="ปกติ">ปกติ</option>
                                    <option {{isset($items) && $items->status=='เพิ่ม'?' selected ':''}} value="เพิ่ม">เพิ่ม</option>
                                    <option {{isset($items) && $items->status=='ถอน'?' selected ':''}} value="ถอน">ถอน</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label >แผนการเรียน:</label>
                                <select name="program_id">
                                    <option value="all">
                                        ทั้งหมด
                                    </option>
                                @foreach($program as $index => $row2)
                                    <option value ="{{$row2->program_id}}" {{Input::get('program_id')==$row2->program_id?'stlected':''}}>
                                        {{$row2->program_id}}
                                    </option>
                                @endforeach
                                </select>
                            </div> 
                        <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>  
</div>

@endsection