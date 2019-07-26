@extends('academic-layout') 
@section('title','เพิ่มข้อมูลลงทะเบียน')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">  
                <div class="panel-heading">
                        @if(isset($items))
                        ลงทะเบียน : {{$items->enro_id}}
                        @else
                        เพิ่มลงทะเบียน
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
                            <div class="form-group">
                                <label >ชื่อนักศึกษา:</label>
                                <select name="std_id">
                                    <option value="all">
                                        ทั้งหมด
                                    </option>
                                @foreach($student as $index => $row1)
                                    <option value ="{{$row1->std_id}}" {{Input::get('std_id')==$row1->std_id?'stlected':''}}>
                                        {{$row1->std_id}}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                            <div>
                                <label >เกรด:</label>
                                <input type="text" name="grade" class="form-control" value="{{isset($items)?$items->grade:''}}"/> 
                            </div>
                            <div>
                                <label >สถานะ:</label>
                                <input type="text" name="status" class="form-control" value="{{isset($items)?$items->status:''}}"/> 
                            </div>
                            <div>
                                <label >วันที่ ลงทะเบียน:</label>
                                <input type="text" name="year" class="form-control" value="{{isset($items)?$items->year:''}}"/> 
                            </div>
                            <div class="form-group">
                                <label >แผนการเรียน:</label>
                                <select name="program_id">
                                    <option value="all">
                                        ทั้งหมด
                                    </option>
                                @foreach($program as $index => $row2)
                                    <option value ="{{$row2->program_id}}" {{Input::get('program_id')==$row2->program_id?'stlected':''}}>
                                        {{$row2->program_name}}
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