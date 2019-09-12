@extends('academic-layout') 
@section('title','เพิ่มการลงทะเบียน')
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
                <a href="/enrolment" class="breadcrumb__point r-link">ลงทะเบียน</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li>
                <li class="breadcrumb__group">
                <a href="/plan/{{$std_id}}" class="breadcrumb__point r-link">รายงานลงทะเบียน</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li>
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">รายงานเพิ่มลงทะเบียน</span>
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
                 <a herf="/plan" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                        @if(isset($student))
                        การลงทะเบียน : ชื่อ {{$student->first_name}} {{$student->last->name}} รหัส {{$student->number}}
                        @else
                        เพิ่มการลงทะเบียน
                        @endif
                    <!-- การลงทะเบียน : ชื่อ -->
                    <a class="btn btn-default pull-right" href="/plan/{{$std_id}}" style="padding-top: 2px;padding-bottom: 2px;" data-toggle="tooltip" title=""><i class="fa fa-close"></i></a>
                </div>
                @if(isset($items))
                <form action="/plan/{{$items->std_id}}" class="form-ajax" method="PUT">
                    <input type="hidden" value="put" name="_mathods">
                    @csrf()
                @else
                <form class="form-ajax" action="/plan" method="POST">
                @csrf()
                @endif
                <input type="hidden" value="{{$std_id}}" name="std_id">

                    <div class="panel-body">
                        <div class="form-group">
                            <label >ภาคเรียน : </label>
                            <select style="width:150px;" name="term_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($term as $index => $row4)
                                <option value ="{{$row4->term_id}}" {{isset($items)&& $items->term_id==$row4->term_id?'selected':''}}>
                                        {{$row4->term_name}}/{{$row4->year}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label >ชื่อวิชา : </label>
                            <select style="width:150px;" name="sub_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($subject as $index => $row3)
                                <option value ="{{$row3->sub_id}}" {{isset($items)&& $items->sub_id==$row3->sub_id?'selected':''}}>
                                        {{$row3->sub_code}}  {{$row3->sub_name}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <div class="panel-body">
                            <th>สถานะ : </th>
                            <select  name="status" class="form-control">
                                <option {{isset($items) && $items->status=='ปกติ'?' selected ':''}} value="ปกติ">ปกติ</option>
                                <option {{isset($items) && $items->status=='ถอน'?' selected ':''}} value="ถอน">ถอน</option>
                            </select>
                        </div>                   
                        <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>  
</div>

@endsection