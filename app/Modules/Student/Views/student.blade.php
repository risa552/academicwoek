@extends('academic-layout') 
@section('title',' นักศึกษา')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาข้อมูลนักศึกษา</div>
                <div class="panel-body">
                    <form action="/student">
                        <div class="form-group">
                            <label for="keyword">ชื่อนักศึกษา</label>
                            <input type="text" name="keyword" class="form-control" value="{{Input::get('keyword')}}" >
                        </div>
                        
                        <button type="submit" class="btn btn-default">ยืนยัน</button>
                    </form>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">นักศึกษา</a></button> -->
        </div> 

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    รายการข้อมูลนักศึกษา
                    <a href="/student/create" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มข้อมูลนักศึกษา</a>
                </div>
                <div class="panel-body">
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ชื่อนักศึกษา</th>
                                <th>นามสกุล</th>
                                <th>เบอร์โทรศัพท์</th>
                                <th>เพศ</th>
                                <th>ที่อยู่</th>
                                <th>E-mail</th>
                                <th>รหัสกลุ่มเรียน</th>
                                <th style="width:110px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($student as $index =>$student)
                            <tr>
                                <td>{{$student->std_fname}}</td>
                                <td>{{$student->std_lname}}</td>
                                <td>{{$student->tel}}</td>
                                <td>{{$student->sex}}</td>
                                <td>{{$student->add}}</td>
                                <td>{{$student->email}}</td>
                                <td>{{$student->group_id}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/student/{{$student->std_id}}"></a>
                                        <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/student/{{$student->std_id}}"></a>
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
