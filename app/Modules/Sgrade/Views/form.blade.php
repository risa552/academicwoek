@extends('academic-layout') 
@section('title','รายเกรดตามห้องเรียน')
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
                <a href="#" class="breadcrumb__point r-link">รายงานเกรดตามห้องที่ปรึกษา</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li>
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">รายงานเกรดห้องที่ปรึกษา</span>
                </li>
            </ol>
            </nav>
        </div>
    <div>
</div>
<div class="container">
    <div class="row">
        
        <div class="col-md-9">
            <div class="panel panel-info">
                <div class="panel-heading">
                รายเกรดตามห้องเรียน กลุ่มเรียน : {{$group->group_name}}
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                               <th>#</th>
                               <th>รหัสนักศึกษา</th>
                               <th>ชื่อ - สกุล</th>
                               <th>เกรด</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $index => $student)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$student->number}}</td>
                                    <td>{{$student->first_name}} {{$student->last_name}}</td>
                                    <td>{{isset($student_gpa[$student->std_id])?$student_gpa[$student->std_id]:'เกรดยังไม่ออก'}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection