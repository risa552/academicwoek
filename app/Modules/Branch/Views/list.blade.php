@extends('academic-layout') 
@section('title','สาขาวิชา')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาสาขาวิชา</div>
                <div class="panel-body">
                    <form action="/branch">
                        <div class="form-group">
                            <label for="keyword">สาขาวิชา</label>
                            <input type="text" name="keyword" class="form-control" value="{{Input::get('keyword')}}">
                        </div>
                        <div class="form-group">
                                <label >หลักสูตร:</label>
                                <select style="width:150px;" name="cou_id">
                                    <option value="all">
                                        ทั้งหมด
                                    </option>
                                @foreach($items2 as $index => $row1)
                                    <option value ="{{$row1->cou_id}}" {{Input::get('cou_id')==$row1->cou_id?'stlected':''}}>
                                        {{$row1->cou_name}}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label >แผนการเรียน:</label>
                                <select style="width:150px;" name="program_id">
                                    <option value="all">
                                        ทั้งหมด
                                    </option>
                                @foreach($items3 as $index => $row2)
                                    <option value ="{{$row2->program_id}}" {{Input::get('program_id')==$row2->program_id?'stlected':''}}>
                                        {{$row2->program_id}}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                        <button type="submit" class="btn btn-default">ยืนยัน</button>
                    </form>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">สาขาวิชา</a></button> -->
        </div> 
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    รายการชื่อสาขาวิชา
                    <a href="/branch/create" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มข้อมูลสาขาวิชา</a>
                </div>
                <div class="panel-body">  
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>ชื่อสาขาวิชา</th>
                                <th>หลักสูตร</th>
                                <th>แผนการเรียน</th>
                                <th style="width:110px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $index => $row)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$row->bran_name}}</td>
                                    <td>{{$row->cou_name}}</td>
                                    <td>{{$row->program_id}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/branch/{{$row->bran_id}}"></a>
                                            <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/branch/{{$row->bran_id}}"></a>
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
