@extends('academic-layout') 
@section('title','ข้อมูลแผนการเรียน')
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
                <a href="/preprogram" class="breadcrumb__point r-link">ข้อมูลแผนการเรียน</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li>
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">ข้อมูลแผนการเรียนของกลุ่ม</span>
                </li>
            </ol>
            </nav>
        </div>
    <div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-info">
                <div class="panel-heading">
                    ข้อมูลแผนการเรียนของกลุ่ม : กลุ่มเรียน : {{$group_show->group_name}}  สาขา : {{$group_show->bran_name}}
                    <a href="/program/create?group_id={{$group_show->group_id}}" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มข้อมูลแผนการเรียน</a>
                </div>
                <div class="panel-body">  
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>รหัสวิชา</th>
                                <th>วิชา</th>
                                <th>ภาคเรียน</th>
                                <th style="width:150px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $index => $row)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$row->sub_code}}</td>
                                    <td>{{$row->sub_name}}<br>{{$row->sub_nameeng}}</td>
                                    <td>{{$row->term_name}}/{{$row->term_year}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <!-- <a class="fa fa-file-text-o btn btn-success" aria-hidden="true" href="/program-report"></a> -->
                                            <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/editprogram/{{$row->program_id}}"></a>
                                            <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/program/{{$row->program_id}}"></a>
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