@extends('academic-layout') 
@section('title','ข้อมูลผู้ดูแลระบบ')
@section('content')
<div class="container">
    <div class="col-md-10">
        <div class="page__section">
            <nav class="breadcrumb breadcrumb_type5" aria-label="Breadcrumb">
            <ol class="breadcrumb__list r-list">
                <li class="breadcrumb__group">
                <a href="/" class="breadcrumb__point r-link"><i class="fa fa-home" aria-hidden="true"></i></a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li>
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">ข้อมูลผู้ดูแลระบบ</span>
                </li>
            </ol>
            </nav>
        </div>
    <div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาข้อมูลผู้ดูแลระบบ</div>
                <div class="panel-body">
                    <form action="/admin">
                        <div class="form-group">
                            <label>ชื่อผู้ดูแลระบบ</label>
                            <input type="text" class="form-control" name="keyword" value="{{Input::get('keyword')}}">
                        </div>
                        <button type="submit" class="btn btn-default">ยืนยัน</button>
                    </form>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">ผู้ดูแลระบบ</a></button> -->
        </div> 

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    รายการข้อมูลผู้ดูแลระบบ
                    <a href="/admin/create" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มข้อมูลผูู้แลระบบ</a>
                </div>
                <div class="panel-body">
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>ชื่อ</th>
                                <th>นามสกุล</th>
                                <th>เบอร์โทรศัพท์</th>
                                <th>เพศ</th>
                                <th>ที่อยู่</th>
                                <th>e-mail</th>
                                <th style="width:110px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($admin as $index => $admin)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$admin->first_name}}</td>
                                <td>{{$admin->last_name}}</td>
                                <td>{{$admin->tel}}</td>
                                <td>{{$admin->sex}}</td>
                                <td>{{$admin->house}}</td>
                                <td>{{$admin->email}}</td>
                                <td>
                                    <div class="btn-group">
                                    <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/admin/{{$admin->admin_id}}"></a>
                                    <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/admin/{{$admin->admin_id}}"></a>
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
