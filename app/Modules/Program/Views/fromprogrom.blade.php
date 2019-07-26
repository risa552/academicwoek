@extends('academic-layout') 
@section('title','เพิ่มข้อมูลแผนการเรียนน')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default"> 
                 <a herf="/program" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                    @if(isset($program))
                    แผนการเรียน : {{$program->program_name}}
                    @else
                    เพิ่มแผนการเรียน
                    @endif
                </div>
                @if(isset($program))
                <form action="/program/{{$program->program_id}}" class="form-ajax" method="PUT">
                    <input type="hidden" value="put" name="_mathods">
                    @csrf()
                @else
                <form class="form-ajax" action="/program" method="POST">
                @csrf()
                @endif
                    <div class="panel-body">
                        <th>ชื่อแผนการเรียน : </th>
                        <input type="text" name="program_name" class="form-control" value="{{isset($educationprogram)?$educationprogram->program_name:''}}"/>
                        <th>หลักสูตร:</th>
                        <input type="text" name="cou_id" class="form-control" value="{{isset($educationprogram)?$educationprogram->cou_id:''}}"/>
                    </div>
                    <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                </form>
        </div>
    </div>  
</div>

@endsection