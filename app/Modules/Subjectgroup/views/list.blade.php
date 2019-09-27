@extends('academic-layout') 
@section('title','ข้อมูลกลุ่มวิชา')
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
                <span class="breadcrumb__point" aria-current="page">ข้อมูลกลุ่มวิชา</span>
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
                <div class="panel-heading">ค้นหากลุ่มวิชา</div>
                <div class="panel-body">
                    <form action="/subjectgroup">
                        <div class="form-group">
                            <label for="keyword">กลุ่มวิชา</label>
                            <input type="text"  name="keyword" class="form-control" value="{{Input::get('keyword')}}" >
                        </div>
                        <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">ข้อมูลกลุ่มวิชา</a></button> -->
        </div> 
        <div class="col-md-9">
            <div class="panel panel-info">
                <div class="panel-heading">
                    รายการข้อมูลกลุ่มวิชา
                    <a href="/subjectgroup/create" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มข้อมูลกลุ่มวิชา</a>
                </div>
                <div class="panel-body">  
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>ชื่อกลุ่มวิชา</th>
                                <th style="width:110px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($items as $index => $item)
                          <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$item->subgroup_name}}</td>
                            <td>
                                <div class="btn-group">
                                       <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/subjectgroup/{{$item->subgroup_id}}"></a>
                                       <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/subjectgroup/{{$item->subgroup_id}}"></a>
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
</div>
@endsection
