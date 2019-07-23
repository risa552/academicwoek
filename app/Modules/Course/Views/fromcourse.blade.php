@extends('academic-layout') 
@section('title','ข้อมูลหลักสูตร')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default"> 
                 <a herf="/course" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                    @if(isset($course))
                    หลักสูตร : {{$course->cou_name}}
                    @else
                    เพิ่มหลักสูตร
                    @endif
                </div>
                @if(isset($course))
                <form action="/course/{{$course->cou_id}}" class="form-ajax" method="PUT">
                    <input type="hidden" value="put" name="_mathods">
                    @csrf()
                @else
                <form class="form-ajax" action="/course" method="POST">
                @csrf()
                @endif
                    <div class="panel-body">
                        <th>ชื่อหลักสูตร : </th>
                        <input type="text" name="cou_name" class="form-control" value="{{isset($course)?$course->cou_name:''}}"/>
                    </div>
                    <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                </form>
        </div>
    </div>  
</div>

@endsection