@extends('academic-layout') 
@section('title','เพิ่มข้อมูลระดับ')
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
                <a href="/degree" class="breadcrumb__point r-link">ข้อมูลระดับ</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li>
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">รายงานเพิ่มข้อมูลระดับ</span>
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
                 <a herf="/degree" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                    @if(isset($degree))
                    ระดับ : {{$degree->degree_name}}
                    @else
                    เพิ่มข้อมูลระดับ
                    @endif
                    <a class="btn btn-default pull-right" href="/degree" style="padding-top: 2px;padding-bottom: 2px;" data-toggle="tooltip" title=""><i class="fa fa-close"></i></a>

                </div>
                @if(isset($degree))
                <form action="/degree/{{$degree->degree_id}}" class="form-ajax" method="PUT">
                    <input type="hidden" value="put" name="_mathods">
                    @csrf()
                @else
                <form class="form-ajax" action="/degree" method="POST">
                @csrf()
                @endif
                    <div class="panel-body">
                        <th>ชื่อระดับ : </th>
                        <input type="text" name="degree_name" class="form-control" value="{{isset($degree)?$degree->degree_name:''}}"/>
                    </div>
                    <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                </form>
        </div>
    </div>  
</div>

@endsection