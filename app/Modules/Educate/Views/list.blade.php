@extends('academic-layout') 
@section('title','ข้อมูลภาระการสอน')
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
                <span class="breadcrumb__point" aria-current="page">ข้อมูลภาระการสอน</span>
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
                <div class="panel-heading">ค้นหาแผนการเรียน</div>
                <div class="panel-body">
                    <form action="/educate">
                    <div class="form-group">
                        <label >ภาคเรียน:</label>
                        <select class="form-control" name="term_id">
                            <option value="all">
                                ทั้งหมด
                            </option>
                        @foreach($terms as $index => $row1)
                            <option value ="{{$row1->term_id}}" {{Input::get('term_id')==$row1->term_id?'selected':''}}> 
                                {{$row1->term_name}}/{{$row1->term_year}}
                            </option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label >กลุ่มเรียน:</label>
                        <select class="form-control" name="group_id">
                            <option value="all">
                                ทั้งหมด
                            </option>
                        @foreach($groups as $index => $row4)
                            <option value ="{{$row4->group_id}}" {{Input::get('group_id')==$row4->group_id?'selected':''}}>
                                {{$row4->group_name}}
                            </option>
                        @endforeach
                        </select>
                    </div>
                        <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
        </div> 

        <div class="col-md-9">
            <div class="panel panel-info">
                <div class="panel-heading">
                    รายการข้อมูลภาระการสอน
                    <a class="fa fa-file-text-o btn btn-success pull-right" aria-hidden="true" href="/educate-report"></a>
                </div>
                <div class="panel-body">  
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <!-- <th>อาจารย์</th> -->
                                <!-- <th>วิชา</th> -->
                                <th>ภาคเรียน</th>
                                <th>กลุ่มเรียน</th>
                                <th>แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $index => $row)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$row->term_name}}/{{$row->term_year}}</td>
                                    <td>{{$row->group_name}}</td>
                                    <td>
                                        <div class="btn-group">
                                        <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/educate-teach?group_id={{$row->group_id}}&term_id={{$row->term_id}}"></a>
                                       <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="#"></a>
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