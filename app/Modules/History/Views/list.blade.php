@extends('academic-layout') 
@section('title','ข้อมูลส่วนตัว')
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
                <!-- <li class="breadcrumb__group">
                <a href="/educate" class="breadcrumb__point r-link">ข้อมูลภาระการสอน</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li> -->
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">ข้อมูลทั่วไป</span>
                </li>
            </ol>
            </nav>
        </div>
    <div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel-body">
                <table class="table table-bordered" style="border: 3px solid #ddd;">
                    <tbody >
                    @foreach($history as $index => $his)
                        <tr>
                            <td style="width:150px;"><b>รหัสนักศึกษา</b></td>
                            <td>{{$his->number}}</td>
                        </tr>
                        <tr>
                            <td style="width:150px;"><b>ชื่อนักศึกษา</b></td>
                            <td>{{$his->first_name}} {{$his->last_name}}</td>
                        </tr>
                        <tr>
                            <td style="width:150px;"><b>กลุ่มเรียน</b></td>
                            <td>{{$his->group_name}}</td>
                        </tr>
                        <tr>
                            <td style="width:150px;"><b>ข้อมูลระดับ</b></td>
                            <td>{{$his->degree_name}}</td>
                        </tr>
                        <tr>
                            <td style="width:150px;"><b>ข้อมูลสาขา</b></td>
                            <td>{{$his->bran_name}}</td>
                        </tr>
                        <tr>
                            <td style="width:150px;"><b>ข้อมูลหลักสูตร</b></td>
                            <td>{{$his->cou_name}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
           </div>
        </div>
    </div>  
</div>

@endsection
