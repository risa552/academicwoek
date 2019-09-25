@extends('academic-layout') 
@section('title','สาขาวิชา')
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
                <a href="/admin" class="breadcrumb__point r-link">ผู้ดูแลระบบ</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li> -->
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">ข้อมูลสาขาวิชา</span>
                </li>
            </ol>
            </nav>
        </div>
    <div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาสาขาวิชา</div>
                <div class="panel-body">
                    <form action="/branch">
                        <div class="form-group">
                            <label for="keyword">สาขาวิชา</label>
                            <input type="text" name="keyword" class="form-control" value="{{Input::get('keyword')}}">
                        </div>
                        <div class="form-group">
                                <label >หลักสูตร:</label>
                                <select style="width:150px;" name="cou_id">
                                    <option value="all">
                                        ทั้งหมด
                                    </option>
                                @foreach($items2 as $index => $row1)
                                    <option value ="{{$row1->cou_id}}" {{Input::get('cou_id')==$row1->cou_id?'stlected':''}}>
                                        {{$row1->cou_name}}[{{$row1->cou_year}}]
                                    </option>
                                @endforeach
                                </select>
                        </div>
                          
                        <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">สาขาวิชา</a></button> -->
        </div> 
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    รายการชื่อสาขาวิชา
                    <a href="/branch/create" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มข้อมูลสาขาวิชา</a>
                </div>
                <div class="panel-body">  
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>ชื่อสาขาวิชา</th>
                                <th>หลักสูตร</th>
                                <th style="width:110px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $index => $row)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$row->bran_name}}</td>
                                    <td>{{$row->cou_name}}[{{$row->cou_year}}]</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/branch/{{$row->bran_id}}"></a>
                                            <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/branch/{{$row->bran_id}}"></a>
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
