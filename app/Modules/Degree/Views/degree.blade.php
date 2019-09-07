@extends('academic-layout') 
@section('title',' ข้อมูลระดับ')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาข้อมูลระดับ</div>
                <div class="panel-body">
                <form action="/degree">
                        <div class="form-group">
                            <label>ชื่อระดับ</label>
                            <input type="text" class="form-control" name="keyword" value="{{Input::get('keyword')}}">
                        </div>
                        <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">ระดับ</a></button> -->
        </div> 

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    รายการข้อมูลระดับ
                    <a href="/degree/create" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> ข้อมูลระดับ</a>
                </div>
                <div class="panel-body">
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>ชื่อระดับ</th>
                                <th style="width:110px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($degree as $index => $degree)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$degree->degree_name}}</td>
                                <td>
                                    <div class="btn-group">
                                    <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/degree/{{$degree->degree_id}}"></a>
                                    <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/degree/{{$degree->degree_id}}"></a>
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
