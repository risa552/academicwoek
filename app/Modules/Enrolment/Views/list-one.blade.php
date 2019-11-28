@extends('academic-layout') 
@section('title','ข้อมูลลงทะเบียน')
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
                <span class="breadcrumb__point" aria-current="page">ข้อมูลการลงทะเบียน</span>
                </li>
            </ol>
            </nav>
        </div>
    <div>
</div>

<div class="row">
        <div class="col-md-3">
            <div class="panel panel-info">
                <div class="panel-heading">ค้นหาข้อมูลลงทะเบียน</div>
                <div class="panel-body">
                    <form action="/enrolment">
                        <div>
                            <label >กลุ่มเรียน:</label>
                            <select class="form-control" >
                             
                            </select>
                        </div>
                        <div>
                            <label >ภาคเรียน:</label>
                            <select class="form-control" >
                             
                            </select>
                        </div>
                        <div>
                            <label>สาขา:</label>
                            <select class="form-control" >
                             
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button> 
                    </form>

                </div>
            </div>
            <!-- <button type="submit" class="btn btn-info"><a href="#">ข้อมูลลงทะเบียน</a></button> -->
        </div> 

        <div class="col-md-9">
            <div class="panel panel-info">
                <div class="panel-heading">
                รายการข้อมูลลงทะเบียน 
                <!-- <a href="#" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> ข้อมูลลงทะเบียน</a> -->
                </div>
        <div class="panel-body">  
            <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>ห้องเรียน</th>
                                <th>ปีการศึกษา</th>
                                <th style="width:150px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groups as $index => $group)
                             <tr> 
                                <td>{{$index+1}}</td>
                                <td>{{$group->group_name}}</td>
                                <td>{{$group->group_year}}</td>
                                <td>
                                    <div class="btn-group">
                                       <a class="fa fa-file-text-o btn btn-success" aria-hidden="true" href=""></a>
                                    </div>
                                </td>
                             </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!--<ul class="pagination">
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                    </ul> -->
                </div>
            </div>
        </div>
    </div>  
@endsection
