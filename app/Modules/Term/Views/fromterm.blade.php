@extends('academic-layout') 
@section('title','เพิ่มข้อมูลภาคเรียน')
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
                <a href="/term" class="breadcrumb__point r-link">ข้อมูลภาคเรียน</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li>
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">เพิ่มข้อมูลภาคเรียน</span>
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
                 <a herf="/term" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                    @if(isset($term))
                    ภาคเรียน : {{$term->term_name}}
                    @else
                    เพิ่มข้อมูลภาคเรียน
                    @endif
                    <a class="btn btn-default pull-right" href="/term" style="padding-top: 2px;padding-bottom: 2px;" data-toggle="tooltip" title=""><i class="fa fa-close"></i></a>

                </div>
                @if(isset($term))
                <form action="/term/{{$term->term_id}}" class="form-ajax" method="PUT">
                    <input type="hidden" value="put" name="_mathods">
                    @csrf()
                @else
                <form class="form-ajax" action="/term" method="POST">
                @csrf()
                @endif
                <div class="panel-body col-md-6">
                    <th>ชื่อภาคเรียน : </th>
                    <select  name="term_name" class="form-control">
                        <option {{isset($term) && $term->term_name==' 1'?' selected ':''}} value=" 1"> 1</option>
                        <option {{isset($term) && $term->term_name==' 2'?' selected ':''}} value=" 2"> 2</option>
                        <option {{isset($term) && $term->term_name==' 3'?' selected ':''}} value=" 3"> 3</option>
                    </select>
                </div>
                <div class="panel-body col-md-6">
                    <th>ปีการศึกษา:</th>
                    <select  name="term_year" class="form-control">
                        @for($i=date('Y')+3;$i>date('Y')-3;$i--)
                        <option {{isset($term) && $term->term_year==($i+543)?' selected ':''}} value="{{($i+543)}}">{{($i+543)}}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group col-md-6">
                        <label for="pwd">วันเปิดภาคการศึกษา:</label>
                        <input type="DATE" name="startdate" class="form-control" value="{{isset($student)?$student->startdate:''}}"/>
                </div>
                <div class="form-group col-md-6">
                        <label for="pwd">วันปิดภาคการศึกษา:</label>
                        <input type="DATE" name="enddate" class="form-control" value="{{isset($student)?$student->enddate:''}}"/>
                </div>
                <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
            </form>
        </div>
    </div>  
</div>

@endsection