@extends('academic-layout') 
@section('title','ข้อมูลนักศึกษา')
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
                <span class="breadcrumb__point" aria-current="page">ข้อมูลนักศึกษา</span>
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
                <div class="panel-heading">ค้นหาข้อมูล</div>
                <div class="panel-body">
                    <form action="/detail">
                        <div class="form-group">
                            <label>ชื่อวิชา</label>
                            <input type="text" class="form-control" name="keyword" value="{{Input::get('keyword')}}">
                        </div>
                        <div class="form-group">
                                <label >ภาคเรียน:</label>
                                <select class="form-control" name="term_id">
                                    <option value="all">
                                        ทั้งหมด
                                    </option>
                                @foreach($term as $index => $row2)
                                    <option value ="{{$row2->term_id}}" {{Input::get('term_id')==$row2->term_id?'stlected':''}}>
                                        {{$row2->term_name}}/{{$row2->term_year}}
                                    </option>
                                @endforeach
                                </select>
                        </div>
                        <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>      
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">ข้อมูลนักศึกษา</a></button> -->
        </div> 

        <div class="col-md-9">
            <div class="panel panel-info">
                <div class="panel-heading">
                    รายการข้อมูลรายละเอียด
                    <a href="/detail/create" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มข้อมูล</a>
                </div>
                <div class="panel-body">  
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>ภาคเรียน</th>
                                <th>วิชา</th>
                                <th>หนักสูตร</th>
                                <th style="width:110px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $index => $row)
                        <tr>
                                <td>{{$index+$items->firstItem()}}</td>
                                <td>{{$row->term_name}}/{{$row->term_year}}</td>
                                <td>{{$row->sub_code}} {{$row->sub_name}} <br>{{$row->sub_name_eng}} </td>
                                <td>{{$row->cou_name}} {{$row->year_name}}</td>
                                <td>
                                    <div class="btn-group">
                                       <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/detail/{{$row->detailpro_id}}"></a>
                                       <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/detail/{{$row->detailpro_id}}"></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $items->render() !!}
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
