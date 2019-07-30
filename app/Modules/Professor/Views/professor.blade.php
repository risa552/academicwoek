@extends('academic-layout') 
@section('title',' ข้อมูลอาจารย์')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาข้อมูลอาจารย์</div>
                <div class="panel-body">
                    <form action="/professor">
                        <div class="form-group">
                            <label for="keyword">ชื่ออาจารย์</label>
                            <input type="text" name="keyword" class="form-control" value="{{Input::get('keyword')}}" >
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
                                <th>ลำดับที่</th>
                                <th>ชื่อ</th>
                                <th>เบอร์</th>
                                <th>เพศ</th>
                                <th>ที่อยู่</th>
                                <th>E-mail</th>
                                <th style="width:110px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($teacher as $index => $professor)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$professor->first_name}} {{$professor->last_name}}</td>
                                <td>{{$professor->tel}}</td>
                                <td>{{$professor->sex}}</td>
                                <td>{{$professor->add}}</td>
                                <td>{{$professor->email}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/professor/{{$professor->teach_id}}"></a>
                                        <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/professor/{{$professor->teach_id}}"></a>
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
