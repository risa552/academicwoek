@extends('academic-layout') 
@section('title','ข้อมูลกลุ่มเรียน')
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
                <span class="breadcrumb__point" aria-current="page">ข้อมูลกลุ่มเรียน</span>
                </li>
            </ol>
            </nav>
        </div>
    <div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <div class="panel panel-info">
                <div class="panel-heading">ค้นหาข้อมูลกลุ่มเรียน</div>
                <div class="panel-body">
                    <form action="/studygroup">
                        <div class="form-group">
                            <label>กลุ่มเรียน</label>
                            <input type="text" class="form-control" name="keyword" value="{{Input::get('keyword')}}">
                        </div>
                        <div class="form-group">
                            <label >สาขา:</label>
                            <select class="form-control" name="bran_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($branch as $index => $row1)
                                <option value ="{{$row1->bran_id}}" {{Input::get('bran_id')==$row1->bran_id?'selected':''}}> 
                                    {{$row1->bran_name}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label >ระดับ:</label>
                            <select class="form-control"  name="degree_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($degree as $index => $row2)
                                <option value ="{{$row2->degree_id}}" {{Input::get('degree_id')==$row2->degree_id?'selected':''}}> 
                                    {{$row2->degree_name}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label >อาจารย์ :</label>
                            <select class="form-control"  name="teach_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($teach as $index => $teacher)
                                <option value ="{{$teacher->teach_id}}" {{Input::get('teach_id')==$teacher->teach_id?'selected':''}}> 
                                    {{$teacher->first_name}} {{$teacher->last_name}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">ข้อมูลกลุ่มเรียน</a></button> -->
        </div> 

        <div class="col-md-10">
            <div class="panel panel-info">
                <div class="panel-heading">
                    รายการข้อมูลกลุ่มเรียน
                    <a href="/studygroup/create" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มข้อมูลกลุ่มเรียน</a>
                </div>
                <div class="panel-body">  
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>กลุ่มเรียน</th>
                                <th>ประเภท</th> 
                                <th>สาขา</th>
                                <th>ระดับ</th>
                                <th>อาจารย์ที่ปรึกษา</th>
                                <th>แผนการเรียน</th>
                                <th style="width:110px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($group as $index => $row)
                        <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$row->group_name}}</td>
                                <td>{{$row->group_type}}</td>
                                <td>{{$row->bran_name}}</td>
                                <td>{{$row->degree_name}}</td>
                                <td>{{$row->first_name}} {{$row->last_name}}</td>
                                <td>{{$row->cou_name}} {{$row->year_name}}</td>
                                <td>
                                    <div class="btn-group">
                                       <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/studygroup/{{$row->group_id}}"></a>
                                       <!-- <a class="fa fa-trash delete-group btn btn-danger" aria-hidden="true" href="/studygroup/{{$row->group_id}}"></a> -->
                                       <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/studygroup/{{$row->group_id}}"></a>
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
