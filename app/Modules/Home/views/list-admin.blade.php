@extends('academic-layout') 
@section('title','หน้าแรก')
@section('content')
<div class="container">
    <div class="col-md-10">
        <div class="page__section">
            <nav class="breadcrumb breadcrumb_type5" aria-label="Breadcrumb">
            <ol class="breadcrumb__list r-list">
                <li class="breadcrumb__group">
                <a href="/" class="breadcrumb__point r-link"><i class="fa fa-home" aria-hidden="true"></i></a>
                </li>
            </ol>
            </nav>
        </div>
    <div>
</div>
<div class="container">
    <div class="row" >
     <div class="col-md-6" style="margin-left:200px;" >
                <div class="panel panel-info">
                    <div class="panel-heading" style="font-size: 18px;">
                    <center> ข้อมูลส่วนตัว
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            @foreach($home as $admin)
                                <tr>
                                    <td><b>ชื่ออาจารย์ :</b>{{$admin->first_name}} {{$admin->last_name}}</td>
                                <tr>
                                <tr>
                                    <td><b>เพศ :</b>{{$admin->sex}} </td>
                                <tr>
                                <tr>
                                    <td><b>เบอร์โทร :</b>{{$admin->tel}} </td>
                                <tr>
                                <tr>
                                    <td><b>ที่อยู่ :</b>{{$admin->house}} </td>
                                <tr>
                                <tr>
                                    <td><b>E-mali :</b>{{$admin->email}} </td>
                                <tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
    </div>  
</div>

@endsection
