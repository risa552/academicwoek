@extends('academic-layout') 
@section('title','เพิ่มข้อมูลนักศึกษา')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default"> 
                 <a herf="/student" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                    @if(isset($student))
                    นักศึกษา : {{$student->std_fname}}
                    @else
                    เพิ่มข้อมูลนักศึกษา
                    @endif
                </div>
                @if(isset($student))
                <form action="/student/{{$student->std_id}}" class="form-ajax" method="PUT">
                    <input type="hidden" value="put" name="_mathods">
                    @csrf()
                @else
                <form class="form-ajax" action="/student" method="POST">
                @csrf()
                @endif
                <div class="panel-body">
                <div class="form-group">
                <div class="form-group">
                        <div class="form-group">
                            <label for="email">ชื่อนักศึกษา:</label>
                            <input type="text" name="std_fname" class="form-control" value="{{isset($student)?$student->std_fname:''}}"/>
                        </div>
                        <div class="form-group">
                            <label for="pwd">นามสกุล:</label>
                            <input type="text" name="std_lname" class="form-control" value="{{isset($student)?$student->std_lname:''}}"/>
                        </div>
                        <div class="form-group">
                            <label for="pwd">เบอร์โทรศัพท์:</label>
                            <input type="text" name="tel" class="form-control" value="{{isset($student)?$student->tel:''}}"/>
                        </div>
                        <div class="form-group">
                            <label for="pwd">เพศ:</label>
                            <input type="text" name="sex" class="form-control" value="{{isset($student)?$student->sex:''}}"/>
                        </div>
                        <div class="form-group">
                            <label for="pwd">ที่อยู่:</label>
                            <input type="text" name="add" class="form-control" value="{{isset($student)?$student->add:''}}"/>
                        </div>
                        <div class="form-group">
                            <label for="pwd">e-mail:</label>
                            <input type="text" name="email" class="form-control" value="{{isset($student)?$student->email:''}}"/>
                        </div>
                        <div class="form-group">
                            <label for="pwd">รหัสกลุ่มเรียน:</label>
                            <input type="text" name="group_id" class="form-control" value="{{isset($student)?$student->group_id:''}}"/>
                        </div>
                    </div>
                    <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                </form>
        </div>
    </div>  
</div>

@endsection