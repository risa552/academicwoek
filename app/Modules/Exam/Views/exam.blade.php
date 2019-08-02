@extends('academic-layout') 
@section('title','การส่งข้อสอบ')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาข้อมูลข้อสอบ</div>
                <div class="panel-body">
                    <form action="/exam">
                        <div class="form-group">
                            <label for="keyword">ข้อมูลข้อสอบ</label>
                            <input type="email" class="form-control" name="keyword" value="{{Input::get('keyword')}}">
                        </div>
                        <button type="submit" class="btn btn-default">ยืนยัน</button>
                    </form>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">ส่งข้อสอบ</a></button> -->
        </div> 
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                รายการการส่งข้อสอบ
               <a href="/exam/create" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> ส่งข้อสอบ</a>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>วันเดือนปีที่ส่งข้อสอบ</th>
                                <th>รหัสวิชา</th>
                                <th>ชื่อวิชา</th>
                                <th>ไฟล์ข้อสอบ</th>
                                <th style="width:110px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($exam as $index => $row)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$row->created_at}}</td>
                                <td>{{$row->sub_code}}</td>
                                <td>{{$row->sub_name}}</td>
                                <td><a target="_blank" href="{{$row->file}}">{{$row->file}}</a></td>
                                <td>
                                    <div class="btn-group">
                                        <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/exam/{{$row->exam_id}}"></a>
                                        <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/exam/{{$row->exam_id}}"></a>
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