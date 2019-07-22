@extends('academic-layout') 
@section('title',' ข้อมูลอาจารย์')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาข้อมูลอาจารย์</div>
                <div class="panel-body">
                    <form action="/action_page.php">
                        <div class="form-group">
                            <label for="keyword">รหัสอาจารย์</label>
                            <input type="text" name="keyword" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="email">ชื่ออาจารย์</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <button type="submit" class="btn btn-default">ยืนยัน</button>
                    </form>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">อาจารย์</a></button> -->
        </div> 

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    รายการข้อมูลอาารย์
                    <a href="/professor/create" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มข้อมูลอาจารย์</a>
                </div>
                <div class="panel-body">
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>รหัสอาจารย์</th>
                                <th>ชื่อ</th>
                                <th>นามสกุล</th>
                                <th>เบอร์</th>
                                <th>เพศ</th>
                                <!--<th>เบอร์</th> -->
                                <th>ที่อยู่</th>
                                <th>E-mail</th>
                                <th>รหัสการสอน</th>
                                <th>รหัสสิทธิ์</th>
                                <th style="width:110px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($teacher as $index => $professor)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$professor->first_name}}</td>
                                <td>{{$professor->last_name}}</td>
                                <td>{{$professor->tel}}</td>
                                <td>{{$professor->sex}}</td>
                                <!--<td>{{$professor->tel}}</td>-->
                                <td>{{$professor->add}}</td>
                                <td>{{$professor->email}}</td>
                                <td>01</td>
                                <td>{{$professor->pre_id}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info"><a class="fa fa-pencil-square" aria-hidden="true" href="/professor/{{$professor->id}}"></a></button>
                                        <button type="button" class="btn btn-danger"><a class="fa fa-trash delete-item" aria-hidden="true" href="/professor/{{$professor->id}}"></a></button>
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
