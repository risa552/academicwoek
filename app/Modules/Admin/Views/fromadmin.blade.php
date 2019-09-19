@extends('academic-layout') 
@section('title','ข้อมูลผู้ดูแลระบบ')
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
                <a href="/admin" class="breadcrumb__point r-link">ข้อมูลผู้ดูแลระบบ</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
               
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">รายงานเพิ่มข้อมูลผู้ดูแลระบบ</span>
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
                 <a herf="/admin" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                    @if(isset($admin))
                    ผู้ดูแลระบบผู้ : {{$admin->first_name}}
                    @else
                    เพิ่มผู้ดูแลระบบ
                    @endif
                    <a class="btn btn-default pull-right" href="/admin" style="padding-top: 2px;padding-bottom: 2px;" data-toggle="tooltip" title=""><i class="fa fa-close"></i></a>
                </div>
                @if(isset($admin))
                <form action="/admin/{{$admin->admin_id}}" class="form-ajax" method="PUT">
                    <input type="hidden" value="put" name="_mathods">
                    @csrf()
                @else
                <form class="form-ajax" action="/admin" method="POST">
                @csrf()
                @endif
                    <div class="panel-body">
                        <th>ชื่อ : </th>
                        <input type="text" name="first_name" class="form-control" value="{{isset($admin)?$admin->first_name:''}}"/>
                    </div>
                    <div class="panel-body">
                        <th>นามสกุล : </th>
                        <input type="text" name="last_name" class="form-control" value="{{isset($admin)?$admin->last_name:''}}"/>
                    </div>
                    <div class="panel-body">
                        <th>เบอร์โทรศัพท์ : </th>
                        <input type="text" name="tel" class="form-control" value="{{isset($admin)?$admin->tel:''}}"/>
                    </div>
                    <div class="panel-body">
                    <label>เพศ:</label>
                            <div class="form-group" >
                                <input name="sex" type="radio" {{isset($admin) && $admin->sex=='ชาย'?'checked':''}} value="ชาย"/>ชาย
                                <input name="sex" type="radio" {{isset($admin) && $admin->sex=='หญิง'?'checked':''}} value="หญิง"/>หญิง
                            </div>
                    </div>
                    <div class="panel-body">
                        <th>ที่อยู่ : </th>
                        <input type="text" name="house" class="form-control" value="{{isset($admin)?$admin->house:''}}"/>
                    </div>
                    <div class="panel-body">
                        <th>e-mail : </th>
                        <input type="text" name="email" class="form-control" value="{{isset($admin)?$admin->email:''}}"/>
                    </div>
                    <div class="form-group">
                        <th>Username:</th>
                        <input type="text" name="username" autocomplate="off" class="form-control" value="{{isset($adminn)?$adminn->username:''}}"/>
                    </div>
                    <div class="form-group">
                        <th>Password:</th>
                        <input type="password" name="password" class="form-control" />
                    </div>  
                    <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                </form>
        </div>
    </div>  
</div>

@endsection