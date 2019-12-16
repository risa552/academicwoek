@extends('academic-layout') 
@section('title','เพิ่มข้อมูลวิชา')
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
                <a href="/subject" class="breadcrumb__point r-link">ข้อมูลวิชา</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li>
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">เพิ่มข้อมูลวิชา</span>
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
                 <a herf="/subject" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                    @if(isset($items))
                    แผนการเรียน : 
                    @else
                    เพิ่มข้อมูลแผนการเรียน
                    @endif
                    <a class="btn btn-default pull-right" href="/preprogram" style="padding-top: 2px;padding-bottom: 2px;" data-toggle="tooltip" title=""><i class="fa fa-close"></i></a>

                </div>
                @if(isset($items))
                <form action="/preprogram/{{$items->program_id}}" class="form-ajax" method="PUT">
                    <input type="hidden" value="put" name="_mathods">
                    @csrf()
                @else
                <form class="form-ajax" action="/preprogram" method="POST">
                @csrf()
                @endif
                <div class="panel-body">
            
                        <div class="form-group col-md-6">
                            <label >ปีการศึกษา:</label>
                            <select class="form-control" name="year_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($years as $index => $row1)
                                <option value ="{{$row1->year_id}}" {{isset($items)&& $items->year_id==$row1->year_id?'selected':''}}>
                                    {{$row1->year_name}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label >หลักสูตร:</label>
                            <select class="form-control" name="cou_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($courses as $index => $cou)
                                <option value ="{{$cou->cou_id}}" {{isset($items)&& $items->cou_id==$cou->cou_id?'selected':''}}>
                                    {{$cou->cou_name}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                    <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                </div>                
                </form>
        </div>
    </div>  
</div>

@endsection