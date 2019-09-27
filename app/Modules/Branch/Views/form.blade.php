@extends('academic-layout') 
@section('title','เพิ่มสาขาวิชา')
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
                <a href="/branch" class="breadcrumb__point r-link">ข้อมูลสาขาวิชา</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li>
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">รายงานเพิ่มข้อมูลสาขาวิชา</span>
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
                 <a herf="/branch" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                    @if(isset($items))
                    สาขา : {{$items->bran_name}}
                    @else
                    เพิ่มสาขา
                    @endif
                    <a class="btn btn-default pull-right" href="/branch" style="padding-top: 2px;padding-bottom: 2px;" data-toggle="tooltip" title=""><i class="fa fa-close"></i></a>
                </div>
                @if(isset($items))
                <form action="/branch/{{$items->bran_id}}" class="form-ajax" method="PUT">
                    <input type="hidden" value="put" name="_mathods">
                    @csrf()
                @else
                <form class="form-ajax" action="/branch" method="POST">
                @csrf()
                @endif
                    <div class="panel-body">
                        <div class="form-group col-md-6">
                            <label >ชื่อสาขา:</label>
                            <input type="text" name="bran_name" class="form-control" value="{{isset($items)?$items->bran_name:''}}"/>
                        </div>
                        <div class="form-group col-md-6">
                            <label >หลักสูตร:</label>
                            <select style="width:300px;" name="cou_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($items2 as $index => $row1)
                                <option value ="{{$row1->cou_id}}" {{isset($items)&& $items->cou_id==$row1->cou_id?'selected':''}}>
                                    {{$row1->cou_name}}[{{$row1->cou_year}}]
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                    </div>
                    <!--<button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button> -->
                </form>
        </div>
    </div>  
</div>

@endsection