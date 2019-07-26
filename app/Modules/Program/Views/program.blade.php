@extends('academic-layout') 
@section('title','ข้อมูลแผนการเรียน')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาแผนการเรียน</div>
                <div class="panel-body">
                    <form action="/program">
                        <div class="form-group">
                            <label for="keyword">ชื่อแผนการเรียน</label>
                            <input type="text" name="keyword" class="form-control" value="{{Input::get('keyword')}}">
                        </div>
                        <button type="submit" class="btn btn-default">ยืนยัน</button>
                    </form>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">ข้อมูลแผนการเรียน</a></button> -->
        </div> 
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    รายการข้อมูลแผนการเรียน
                    <a href="/program/create" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มข้อมูลแผนการเรียน</a>
                </div>
                <div class="panel-body">  
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>ชื่อแผนการเรียน</th>
                                <th>รหัสหลักสูตร</th>
                                <th style="width:110px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($educationprogram as $index => $program)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$program->program_name}}</td>
                                    <td>{{$program->cou_id}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/program/{{$program->program_id}}"></a>
                                            <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/program/{{$program->program_id}}"></a>
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