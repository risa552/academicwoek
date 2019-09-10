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
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาข้อมูลลงทะเบียน</div>
                <div class="panel-body">
                    <form action="/enrolment">
                        <div class="form-group">
                            <label>ชื่อนักศึกษา</label>
                            <input type="text" class="form-control" name="keyword" value="{{Input::get('keyword')}}">
                        </div>
                        <div>
                            <label >ภาคเรียน:</label>
                            <select name="term_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($terms as $index => $row3)
                                <option value ="{{$row3->term_id}}" {{Input::get('term_id')==$row3->term_id?'stlected':''}}>
                                    {{$row3->term_name}}/{{$row3->year}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <div>
                            <label >สาขา:</label>
                            <select name="bran_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($bran as $index => $row4)
                                <option value ="{{$row4->bran_id}}" {{Input::get('bran_id')==$row4->bran_id?'stlected':''}}>
                                    {{$row4->bran_name}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
            <!-- <button type="submit" class="btn btn-info"><a href="#">ข้อมูลลงทะเบียน</a></button> -->
        </div> 

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                รายการข้อมูลลงทะเบียน 
                <!-- <a href="#" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> ข้อมูลลงทะเบียน</a> -->
                </div>
        <div class="panel-body">  
            <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>รหัสนักศึกษา</th>
                                <th>ชื่อนักศึกษา</th>
                                <th style="width:150px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $index => $row)
                        <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$row->number}}</td>
                                <td>{{$row->first_name}} {{$row->last_name}}</td>
                                <td>
                                    <div class="btn-group">
                                       <a class="fa fa-file-text-o btn btn-success" aria-hidden="true" href="/plan/{{$row->std_id}}"></a>
                                       <!-- <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/enrolment"></a>
                                       <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/enrolment"></a> -->
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
