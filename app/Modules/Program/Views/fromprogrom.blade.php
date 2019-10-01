@extends('academic-layout') 
@section('title','เพิ่มข้อมูลแผนการเรียนน')
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
                <a href="/preprogram" class="breadcrumb__point r-link">แผนการเรียน</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li>
                <li class="breadcrumb__group">
                <a href="/program/{{$group_id}}" class="breadcrumb__point r-link">ข้อมูลแผนการเรียนของกลุ่มเรียน</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li>
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">รายงานเพิ่มข้อมูลแผนการเรียน</span>
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
                 <a herf="/program/{{$group_id}}" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                    รายงานเพิ่มข้อมูลแผนการเรียน
                    <a class="btn btn-default pull-right" href="/program/{{$group_id}}" style="padding-top: 2px;padding-bottom: 2px;" data-toggle="tooltip" title=""><i class="fa fa-close"></i></a>

                </div>
                <form action="{{$action}}" class="form-ajax" method="{{$method}}">
                    @csrf()
                    <input type="hidden" value="{{$group_id}}" name="group_id">

                <div class="panel-body">
                    <div class="form-group">
                        <label >กลุ่มเรียน : {{$group_name}}</label>
                    </div>
                    <div class="form-group">
                        <label >ภาคเรียน:</label>
                        <select style="width:150px;" name="term_id">
                            <option value="all">
                                ทั้งหมด
                            </option>
                        @foreach($terms as $index => $row2)
                            <option value ="{{$row2->term_id}}" {{isset($program)&& $program->term_id==$row2->term_id?'selected':''}}>
                                {{$row2->term_name}}/{{$row2->term_year}}
                            </option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label >วิชา:</label>
                        <select style="width:500px;" name="sub_id">
                            <option value="all">
                                ทั้งหมด
                            </option>
                        @foreach($subjects as $index => $row3)
                            <option value ="{{$row3->sub_id}}" {{isset($program)&& $program->sub_id==$row3->sub_id?'selected':''}}>
                                     {{$row3->sub_code}}  {{$row3->sub_name}}  {{$row3->sub_nameeng}}
                            </option>
                        @endforeach
                        </select>
                    </div>
                    <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                </form>
        </div>
    </div>  
</div>

@endsection