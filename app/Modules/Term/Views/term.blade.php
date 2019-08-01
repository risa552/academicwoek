@extends('academic-layout') 
@section('title',' ภาคเรียน')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาข้อมูลภาคเรียน</div>
                <div class="panel-body">
                    <form action="/term">
                        <div class="form-group">
                            <label for="keyword">ชื่อภาคเรียน</label>
                            <input type="text" name="keyword" class="form-control" value="{{Input::get('keyword')}}" >
                        </div>
                        
                        <button type="submit" class="btn btn-default">ยืนยัน</button>
                    </form>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">ภาคเรียน</a></button> -->
        </div> 

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    รายการข้อมูลภาคเรียน
                    <a href="/term/create" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มข้อมูลภาคเรียน</a>
                </div>
                <div class="panel-body">
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>ชื่อภาคเรียน</th>
                                <th>ปีการศึกษา</th>
                                <th>วันเปิดภาคการศึกษา</th>
                                <th>วันปิดภาคการศึกษา</th>
                                <th style="width:110px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($term as $index =>$row)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$row->term_name}}</td>
                                <td>{{$row->year}}</td>
                                <td>{{$row->startdate}}</td>
                                <td>{{$row->enddate}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/term/{{$row->term_id}}"></a>
                                        <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/term/{{$row->term_id}}"></a>
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
