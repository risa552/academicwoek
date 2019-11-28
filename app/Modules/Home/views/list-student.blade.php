@extends('academic-layout') 
@section('title','หน้าแรก')
@section('content')
<div class="container">
    <div class="col-md-10">
        <div class="page__section">
            <nav class="breadcrumb breadcrumb_type5" aria-label="Breadcrumb">
            <ol class="breadcrumb__list r-list">
                <li class="breadcrumb__group">
                <a href="/" class="breadcrumb__point r-link"><i class="fa fa-home" aria-hidden="true"></i></a>
                </li>
            </ol>
            </nav>
        </div>
    <div>
</div>
<div class="container">
    <div class="row" >
            <div class="col-md-6"  >
                <div class="panel panel-info">
                    <div class="panel-heading" style="font-size: 18px;">
                       <center> ประวัติส่วนตัว
                    </div>
                    <div class="panel-body">
                        <table class="table table-responsive">
                        @foreach($home as $student)
                            <tr>
                                <td><b>รหัสนักศึกษา :</b>{{$student->number}} </td>
                            <tr>
                            <tr>
                                <td><b>ชื่อนักศึกษา :</b>{{$student->first_name}} {{$student->last_name}}</td>
                            <tr>
                            <tr>
                                <td><b>เบอร์โทร :</b>{{$student->tel}} </td>
                            <tr>
                            <tr>
                                <td><b>ที่อยู่ :</b>{{$student->add}} </td>
                            <tr>
                            <tr>
                                <td><b>กลุ่มเรียน :</b>{{$student->group_name}} </td>
                            <tr>
                            <tr>
                                <td><b>ระดับ :</b>{{$student->degree_name}} </td>
                            <tr>
                            <tr>
                                <td><b>สาขา :</b>{{$student->bran_name}} </td>
                            <tr>
                            <tr>
                                <td><b>หลักสูตร:</b>{{$student->cou_name}} </td>
                            <tr>
                        @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6"  >
                <div class="panel panel-info">
                    <div class="panel-heading" style="font-size: 18px;">
                    <center> ข้อมูลอาจารย์ที่ปรึกษา
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            @foreach($hometeach as $teacher)
                                <tr>
                                    <td><b>ชื่ออาจารย์ :</b>{{$teacher->first_name}} {{$teacher->last_name}}</td>
                                <tr>
                                <tr>
                                    <td><b>เบอร์โทร :</b>{{$teacher->tel}} </td>
                                <tr>
                                <tr>
                                    <td><b>ที่อยู่ :</b>{{$teacher->add}} </td>
                                <tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        
    </div>  
</div>

@endsection
