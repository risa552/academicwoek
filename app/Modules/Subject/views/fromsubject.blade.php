@extends('academic-layout') 
@section('title','เพิ่มข้อมูลวิชา')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default"> 
                 <a herf="/subject" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                    @if(isset($subject))
                    วิชา : {{$subject->sub_name}}
                    @else
                    เพิ่มข้อมูลวิชา
                    @endif
                </div>
                @if(isset($subject))
                <form action="/subject/{{$subject->sub_id}}" class="form-ajax" method="PUT">
                    <input type="hidden" value="put" name="_mathods">
                    @csrf()
                @else
                <form class="form-ajax" action="/subject" method="POST">
                @csrf()
                @endif
                <div class="panel-body">
                        <div class="form-group">
                            <label for="email">ชื่อวิชา:</label>
                            <input type="text" name="sub_name" class="form-control" value="{{isset($subject)?$subject->sub_name:''}}"/>
                        </div>
                        <div class="form-group">
                            <label for="pwd">หน่วยกิต:</label>
                            <input type="text" name="credit" class="form-control" value="{{isset($subject)?$subject->credit:''}}"/>
                        </div>
                        <div class="form-group">
                            <label for="pwd">ชั่วโมงทฎษฎี:</label>
                            <input type="text" name="theory" class="form-control" value="{{isset($subject)?$subject->theory:''}}"/>
                        </div>
                        <div class="form-group">
                            <label for="pwd">ชั่วโมงปฎิบัติ:</label>
                            <input type="text" name="practice" class="form-control" value="{{isset($subject)?$subject->practice:''}}"/>
                        </div>
                    </div>
                    <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                </form>
        </div>
    </div>  
</div>

@endsection