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
            <div class="panel panel-info"> 
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
                        <div class="form-group col-md-4">
                            <label for="email">รหัสนักศึกษา: <i class="fa fa-asterisk fa-sm" style="color:#FF0000; font-size: 0.8rem;"  aria-hidden="true"></i></label>
                            <input type="text" name="number" class="form-control" value="{{isset($student)?$student->number:''}}"/>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email">ชื่อนักศึกษา: <i class="fa fa-asterisk fa-sm" style="color:#FF0000; font-size: 0.8rem;"  aria-hidden="true"></i></label>
                            <input type="text" name="first_name" class="form-control" value="{{isset($student)?$student->first_name:''}}"/>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="pwd">นามสกุล: <i class="fa fa-asterisk fa-sm" style="color:#FF0000; font-size: 0.8rem;"  aria-hidden="true"></i></label>
                            <input type="text" name="last_name" class="form-control" value="{{isset($student)?$student->last_name:''}}"/>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="pwd">เบอร์โทรศัพท์:</label>
                            <input type="text" name="tel" class="form-control" value="{{isset($student)?$student->tel:''}}"/>
                        </div>
                        <div class="form-group col-md-2" >
                            <label>เพศ: <i class="fa fa-asterisk fa-sm" style="color:#FF0000; font-size: 0.8rem;"  aria-hidden="true"></i></label>
                            <select  name="sex" class="form-control">
                                <option {{isset($student) && $student->sex==' ชาย'?' selected ':''}} value=" ชาย"> ชาย</option>
                                <option {{isset($student) && $student->sex==' หญิง'?' selected ':''}} value=" หญิง"> หญิง</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pwd">e-mail:</label>
                            <input type="text" name="email" class="form-control" value="{{isset($student)?$student->email:''}}"/>
                        </div>
                        <div class="form-group col-md-9">
                            <label for="pwd">ที่อยู่: <i class="fa fa-asterisk fa-sm" style="color:#FF0000; font-size: 0.8rem;"  aria-hidden="true"></i></label>
                            <input type="text" name="add" class="form-control" value="{{isset($student)?$student->add:''}}"/>
                        </div>
                        
                        <div class="form-group col-md-3">
                                <label >กลุ่มเรียน: <i class="fa fa-asterisk fa-sm" style="color:#FF0000; font-size: 0.8rem;"  aria-hidden="true"></i></label>
                                <select class="form-control" name="group_id">
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
                        <div class="form-group col-md-6">
                            <th>Username: <i class="fa fa-asterisk fa-sm" style="color:#FF0000; font-size: 0.8rem;"  aria-hidden="true"></i></th>
                            <input type="text" name="username" {{isset($student)?' disabled':''}}  autocomplate="off" class="form-control" value="{{isset($student)?$student->username:''}}"/>
                        </div>
                        <div class="form-group col-md-6">
                            <th>Password: <i class="fa fa-asterisk fa-sm" style="color:#FF0000; font-size: 0.8rem;"  aria-hidden="true"></i></th>
                            <input type="password" name="password" class="form-control" />
                        </div>  
                    <i class="fa fa-asterisk fa-sm" style="color:#FF0000; font-size: 0.8rem;"  aria-hidden="true"></i> <p>จำเป็นต้องใส่</p>

                </div> 
                <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>

                </form>
        </div>
    
    
    </div>  
</div>

@endsection