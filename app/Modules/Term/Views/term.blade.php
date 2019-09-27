@extends('academic-layout') 
@section('title',' ภาคเรียน')
@section('content')
<div class="container">
    <div class="col-md-10">
        <div class="page__section">
            <nav class="breadcrumb breadcrumb_type5" aria-label="Breadcrumb">
            <ol class="breadcrumb__list r-list">
                <li class="breadcrumb__group">
                <a href="/" class="breadcrumb__point r-link"><i class="fa fa-home" aria-hidden="true"></i></a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                <!-- </li>
                <li class="breadcrumb__group">
                <a href="/professor" class="breadcrumb__point r-link">ข้อมูลอาจารย์</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li> -->
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">ข้อมูลภาคเรียน</span>
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
                <div class="panel-heading">ค้นหาข้อมูลภาคเรียน</div>
                <div class="panel-body">
                    <form action="/term">
                        <div class="form-group">
                            <label for="keyword">ชื่อภาคเรียน</label>
                            <input type="text" name="keyword" class="form-control" value="{{Input::get('keyword')}}" >
                        </div>
                        
                        <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">ภาคเรียน</a></button> -->
        </div> 

        <div class="col-md-9">
            <div class="panel panel-info">
                <div class="panel-heading">
                    รายการข้อมูลภาคเรียน
                    <a href="/term/create" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มข้อมูลภาคเรียน</a>
                </div>
                <div class="panel-body">
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <!-- <th>ชื่อภาคเรียน</th> -->
                                <th>ปีการศึกษา</th>
                                <th>วันเปิดภาคการศึกษา</th>
                                <th>วันปิดภาคการศึกษา</th>
                                <th style="width:110px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($term as $index =>$row)
                            <tr>
                                <td>{{$index+1}}</td>
                                <!-- <td>{{$row->term_name}}</td> -->
                                <td>{{$row->term_name}}/{{$row->term_year}}</td>
                                <td>{{$row->startdate}}</td>
                                <td>{{$row->enddate}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/term/{{$row->term_id}}"></a>
                                        <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/term/{{$row->term_id}}"></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>  
</div>
@endsection
