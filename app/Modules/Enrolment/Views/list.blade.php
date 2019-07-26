@extends('academic-layout') 
@section('title','ข้อมูลลงทะเบียน')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาข้อมูลลงทะเบียน</div>
                <div class="panel-body">
                    <form action="/enrolment">
                        <div class="form-group">
                            <label>วันที่ลงทะเบียน</label>
                            <input type="text" class="form-control" name="keyword" value="{{Input::get('keyword')}}">
                        </div>
                        <button type="submit" class="btn btn-default">ยืนยัน</button>
                    </form>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">ข้อมูลลงทะเบียน</a></button> -->
        </div> 

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    รายการข้อมูลลงทะเบียน
                    <a href="/enrolment/create" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มข้อมูลลงทะเบียน</a>
                </div>
                <div class="panel-body">  
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>ชื่อนักศึกษา</th>
                                <th>เกรด</th>
                                <th>สถานะ</th>
                                <th>วันที่ ลงทะเบียน</th>
                                <th>แผนการเรียน</th>
                                <th style="width:110px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $index => $row)
                        <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$row->std_fname}}</td>
                                <td>{{$row->grade}}</td>
                                <td>{{$row->status}}</td>
                                <td>{{$row->year}}</td>
                                <td>{{$row->program_name}}</td>
                                <td>
                                    <div class="btn-group">
                                       <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/enrolment/{{$row->enro_id}}"></a>
                                       <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/enrolment/{{$row->enro_id}}"></a>
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
