@extends('academic-layout') 
@section('title','เพิ่มข้อมูลอาจารย์')
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
                <a href="/professor" class="breadcrumb__point r-link">ข้อมูลอาจารย์</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li>
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">รายงานเพิ่มข้อมูลอาจารย์</span>
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
                 <a herf="/professor" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                    @if(isset($professor))
                    อาจารย์ : {{$professor->first_name}}
                    @else
                    เพิ่มอาจารย์
                    @endif
                    <a class="btn btn-default pull-right" href="/professor" style="padding-top: 2px;padding-bottom: 2px;" data-toggle="tooltip" title=""><i class="fa fa-close"></i></a>

                </div>
                @if(isset($professor))
                <form action="/professor/{{$professor->teach_id}}" class="form-ajax" method="PUT">
                    <input type="hidden" value="put" name="_mathods">
                    @csrf()
                @else
                <form class="form-ajax" action="/professor" method="POST">
                @csrf()
                @endif
                    <div class="panel-body">
                        <label>ชื่อ : </label>
                            <input type="text" name="first_name" class="form-control" value="{{isset($professor)?$professor->first_name:''}}"/>
                        <label>นามสกุล:</label>
                             <input type="text" name="last_name" class="form-control" value="{{isset($professor)?$professor->last_name:''}}"/> 
                        <label>เบอร์:</label>
                             <input type="text" name="tel" class="form-control" value="{{isset($professor)?$professor->tel:''}}"/>  
                        <label>เพศ:</label>
                            <div class="form-group" >
                                <input name="sex" type="radio" {{isset($professor) && $professor->sex=='ชาย'?'checked':''}} value="ชาย"/>ชาย
                                <input name="sex" type="radio" {{isset($professor) && $professor->sex=='หญิง'?'checked':''}} value="หญิง"/>หญิง
                            </div>
                        <label>ที่อยู่:</label>
                            <input type="text" name="add" class="form-control" value="{{isset($professor)?$professor->add:''}}"/>
                        <label>email:</label>
                            <input type="text" name="email" class="form-control" value="{{isset($professor)?$professor->email:''}}"/> 
                        <div class="form-group">
                            <label>Username:</label>
                                <input type="text" name="username" autocomplate="off" class="form-control" value="{{isset($professor)?$professor->username:''}}"/>
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                                <input type="password" name="password" class="form-control" />
                        </div>   
                    </div>   
                    <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                </form>
        </div>
    </div>  
</div>

@endsection