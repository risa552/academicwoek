@extends('academic-layout') 
@section('title','ข้อมูลนักศึกษา')
@section('content')
<div class="container">
    <div class="col-md-10">
        <div class="page__section">
            <nav class="breadcrumb breadcrumb_type5" aria-label="Breadcrumb">
            <ol class="breadcrumb__list r-list">
                <li class="breadcrumb__group">
                <a href="/" class="breadcrumb__point r-link"><i class="fa fa-home" aria-hidden="true"></i></a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li>
                <li class="breadcrumb__group">
                <a href="/student" class="breadcrumb__point r-link">ข้อมูลนักศึกษา</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li>
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">เพิ่มข้อมูลนักศึกษา</span>
                </li>
            </ol>
            </nav>
        </div>
    <div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default"> 
                 <a herf="/student" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                        @if(isset($student))
                    นักศึกษา : {{$student->first_name}}
                        @else
                    เพิ่มข้อมูลนักศึกษา
                        @endif
                    <a class="btn btn-default pull-right" href="/student" style="padding-top: 2px;padding-bottom: 2px;" data-toggle="tooltip" title=""><i class="fa fa-close"></i></a>

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
                            <label for="email">รหัสนักศึกษา:</label>
                            <input type="text" name="number" class="form-control" value="{{isset($student)?$student->number:''}}"/>
                        </div>
                        <div class="form-group">
                            <label for="email">ชื่อนักศึกษา:</label>
                            <input type="text" name="first_name" class="form-control" value="{{isset($student)?$student->first_name:''}}"/>
                        </div>
                        <div class="form-group">
                            <label for="pwd">นามสกุล:</label>
                            <input type="text" name="last_name" class="form-control" value="{{isset($student)?$student->last_name:''}}"/>
                        </div>
                        <div class="form-group">
                            <label for="pwd">เบอร์โทรศัพท์:</label>
                            <input type="text" name="tel" class="form-control" value="{{isset($student)?$student->tel:''}}"/>
                        </div>
                        <label>เพศ:</label>
                            <div class="form-group" >
                                <input name="sex" type="radio" {{isset($professor) && $professor->sex=='ชาย'?'checked':''}} value="ชาย"/>ชาย
                                <input name="sex" type="radio" {{isset($professor) && $professor->sex=='หญิง'?'checked':''}} value="หญิง"/>หญิง
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
                                <label >กลุ่มเรียน:</label>
                                <select name="group_id">
                                    <option value="all">
                                        ทั้งหมด
                                    </option>
                                @foreach($studygroup as $index => $row2)
                                    <option value ="{{$row2->group_id}}" {{isset($student)&& $student->group_id==$row2->group_id?'selected':''}}>
                                        {{$row2->group_name}}
                                    </option>
                                @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <th>Username:</th>
                            <input type="text" name="username" autocomplate="off" class="form-control" value="{{isset($student)?$student->username:''}}"/>
                        </div>
                        <div class="form-group">
                            <th>Password:</th>
                            <input type="password" name="password" class="form-control" />
                        </div>  
                    <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                </form>
        </div>
    
    
    </div>  
</div>

@endsection