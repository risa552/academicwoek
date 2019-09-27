@extends('academic-layout') 
@section('title','ข้อมูลหลักสูตร')
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
                <a href="/course" class="breadcrumb__point r-link">ข้อมูลหลักสูตร</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li>
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">รายงานเพิ่มข้อมูลหลักสูตร</span>
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
                 <a herf="/course" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                    @if(isset($course))
                    หลักสูตร : {{$course->cou_name}}
                    @else
                    เพิ่มหลักสูตร
                    @endif
                    <a class="btn btn-default pull-right" href="/course" style="padding-top: 2px;padding-bottom: 2px;" data-toggle="tooltip" title=""><i class="fa fa-close"></i></a>

                </div>
                @if(isset($course))
                <form action="/course/{{$course->cou_id}}" class="form-ajax" method="PUT">
                    <input type="hidden" value="put" name="_mathods">
                    @csrf()
                @else
                <form class="form-ajax" action="/course" method="POST">
                @csrf()
                @endif
                    <div class="panel-body col-md-6">
                        <label>ชื่อหลักสูตร : </label>
                        <input type="text" name="cou_name" class="form-control" value="{{isset($course)?$course->cou_name:''}}"/>
                    </div>
                    <div class="panel-body col-md-6">
                        <label>ปีที่ปรับปรุง : </label>
                        <input type="text" name="cou_year" class="form-control" value="{{isset($course)?$course->cou_year:''}}"/>
                    </div>
                    <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                </form>
        </div>
    </div>  
</div>

@endsection