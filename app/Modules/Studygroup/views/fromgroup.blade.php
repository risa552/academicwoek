@extends('academic-layout') 
@section('title','เพิ่มข้อมูลกลุ่มเรียน')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">  
                <div class="panel-heading">
                        @if(isset($studygroup))
                        กลุ่มเรียน : {{$studygroup->group}}
                        @else
                        เพิ่มกลุ่มเรียน
                        @endif
                </div>
                    @if(isset($studygroup))
                    <form action="/studygroup/{{$studygroup->id}}" class="form-ajax" method="PUT">
                        <input type="hidden" value="put" name="_mathods">
                        @csrf()
                    @else
                    <form class="form-ajax" action="/studygroup" method="POST">
                    @csrf()
                    @endif
                    <div class="panel-body">
                        <th>รหัส : </th>
                        <input type="text" name="group" class="form-control" value="{{isset($studygroup)?$studygroup->group:''}}"/> 
                        <th>ปีที่เข้าศึกษา:</th>
                        <input type="text" name="year" class="form-control" value="{{isset($studygroup)?$studygroup->year:''}}"/> 
                        <th>สาขา:</th>
                        <input type="text" name="bran_id" class="form-control" value="{{isset($studygroup)?$studygroup->bran_id:''}}"/>
                        <th>ระดับ:</th>
                        <input type="text" name="degree_id" class="form-control" value="{{isset($studygroup)?$studygroup->degree_id:''}}"/>
                    </div>
                    <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                </form>
            </div>
        </div>
    </div>  
</div>

@endsection