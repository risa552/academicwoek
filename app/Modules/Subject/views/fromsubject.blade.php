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
            <div class="panel panel-default"> 
                 <a herf="/subject" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                    @if(isset($items))
                    วิชา : {{$items->sub_name}}
                    @else
                    เพิ่มข้อมูลวิชา
                    @endif
                    <a class="btn btn-default pull-right" href="/subject" style="padding-top: 2px;padding-bottom: 2px;" data-toggle="tooltip" title=""><i class="fa fa-close"></i></a>

                </div>
                @if(isset($items))
                <form action="/subject/{{$items->sub_id}}" class="form-ajax" method="PUT">
                    <input type="hidden" value="put" name="_mathods">
                    @csrf()
                @else
                <form class="form-ajax" action="/subject" method="POST">
                @csrf()
                @endif
                <div class="panel-body">
                         <div class="form-group">
                            <label>รหัสวิชา:</label>
                            <input type="text" name="sub_code" class="form-control" value="{{isset($items)?$items->sub_code:''}}"/>
                        </div>
                        <div class="form-group">
                            <label>ชื่อวิชา:</label>
                            <input type="text" name="sub_name" class="form-control" value="{{isset($items)?$items->sub_name:''}}"/>
                        </div>
                        <div class="form-group">
                            <label>ชื่อวิชาอังกฤษ:</label>
                            <input type="text" name="sub_nameeng" class="form-control" value="{{isset($items)?$items->sub_nameeng:''}}"/>
                        </div>
                        <div class="form-group">
                            <label>หน่วยกิต:</label>
                            <input type="text" name="credit" class="form-control" value="{{isset($items)?$items->credit:''}}"/>
                        </div>
                        <div class="form-group">
                            <label>ชั่วโมงทฎษฎี:</label>
                            <input type="text" name="theory" class="form-control" value="{{isset($items)?$items->theory:''}}"/>
                        </div>
                        <div class="form-group">
                            <label>ชั่วโมงปฎิบัติ:</label>
                            <input type="text" name="practice" class="form-control" value="{{isset($items)?$items->practice:''}}"/>
                        </div>
                        <div class="form-group">
                            <label >กลุ่มวิชา:</label>
                            <select name="subgroup_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($items2 as $index => $row1)
                                <option value ="{{$row1->subgroup_id}}" {{isset($items)&& $items->subgroup_id==$row1->subgroup_id?'selected':''}}>
                                    {{$row1->subgroup_name}}
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