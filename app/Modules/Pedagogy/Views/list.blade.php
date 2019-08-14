@extends('academic-layout') 
@section('title','ข้อมูลภาระการสอน')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default"> 
                 <a herf="/pedagogy" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                    @if(isset($educate))
                ภาระการสอน : {{$educate->educate_id}}
                    @else
                เพิ่มข้อมูลภาระการสอน
                    @endif
                </div>
                @if(isset($educate))
                <form action="/pedagogy/{{$educate->educate_id}}" class="form-ajax" method="PUT">
                    <input type="hidden" value="put" name="_mathods">
                    @csrf()
                @else
                <form class="form-ajax" action="/pedagogy" method="POST">
                @csrf()
                @endif
                <div class="panel-body">
                <div class="form-group">
                            <label for="email">ชื่ออาจารย์:</label>
                            <input type="text" name="first_name" class="form-control" value="{{isset($pedagogy)?$pedagogy->first_name:''}}"/>
                        </div>
                        <div class="form-group">
                            <label for="email">นามสกุล:</label>
                            <input type="text" name="last_name" class="form-control" value="{{isset($pedagogy)?$pedagogy->last_name:''}}"/>
                        </div>
                        <div class="form-group">
                            <label for="pwd">รหัสวิชา:</label>
                            <input type="text" name="sub_code" class="form-control" value="{{isset($pedagogy)?$pedagogy->sub_code:''}}"/>
                        </div>
                        <div class="form-group">
                            <label for="pwd">ชื่อวิชา:</label>
                            <input type="text" name="sub_name" class="form-control" value="{{isset($pedagogy)?$pedagogy->sub_name:''}}"/>
                        </div>
                        <div class="form-group">
                            <label for="pwd">หน่วยกิต:</label>
                            <input type="text" name="credit" class="form-control" value="{{isset($pedagogy)?$pedagogy->credit:''}}"/>
                        </div>
                        <div class="form-group">
                            <label for="pwd">ชั่วโมงทฤษฎี:</label>
                            <input type="text" name="theory" class="form-control" value="{{isset($pedagogy)?$pedagogy->theory:''}}"/>
                        </div>
                        <div class="form-group">
                            <label for="pwd">ชั่วโมงปฎิบัติ:</label>
                            <input type="text" name="practice" class="form-control" value="{{isset($pedagogy)?$pedagogy->practice:''}}"/>
                        </div>
                        <div class="form-group">
                            <label for="pwd">กลุ่มเรียน:</label>
                            <input type="text" name="group_name" class="form-control" value="{{isset($pedagogy)?$pedagogy->group_name:''}}"/>
                        </div>
                    <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                </form>
         </div>
    </div>  
</div>

@endsection