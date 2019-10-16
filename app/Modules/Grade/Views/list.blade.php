@extends('academic-layout') 
@section('title','ออกเกรด')
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
                <!-- <li class="breadcrumb__group">
                <a href="/educate" class="breadcrumb__point r-link">ข้อมูลภาระการสอน</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li> -->
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">การออกเกรด</span>
                </li>
            </ol>
            </nav>
        </div>
    <div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-info">
                <div class="panel-heading">ค้นหาข้อมูลการออกเกรด</div>
                <div class="panel-body">
                    <form action="/grade">
                    
                        <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">อาจารย์</a></button> -->
        </div> 
        <form class="form-ajax" method="POST" action="/grade">
            <div class="col-md-9">
                <div class="panel panel-info">
                    <div class="panel-heading">
                    รายการการออกเกรด
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ชื่อวิชา</th>
                                    <th>กลุ่มเรียน</th>
                                   <!-- <th>คะแนน/เกรด</th> -->
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($teach as $index => $row)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$row->sub_code}} {{$row->sub_name}} <br> {{$row->sub_nameeng}}</td>
                                    <td>{{$row->group_name}}</td>                                   
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <button tyep="button" class="pull-right">ยืนยัน </button>
                       
                    </div>
                </div>
            </div>
        </form>
        
    </div>  
</div>

@endsection
