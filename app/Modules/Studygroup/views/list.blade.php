@extends('academic-layout') 
@section('title','ข้อมูลกลุ่มเรียน')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาข้อมูลกลุ่มเรียน</div>
                <div class="panel-body">
                    <form action="/studygroup">
                        <div class="form-group">
                            <label>รหัสกลุ่มเรียน</label>
                            <input type="text" class="form-control" name="keyword" value="{{Input::get('keyword')}}">
                        </div>
                        <div class="form-group">
                            <label >สาขา:</label>
                            <select style="width:150px;" name="bran_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($branch as $index => $row1)
                                <option value ="{{$row1->bran_id}}" {{Input::get('bran_id')==$row1->bran_id?'selected':''}}> 
                                    {{$row1->bran_name}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label >ระดับ:</label>
                            <select style="width:150px;" name="degree_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($degree as $index => $row2)
                                <option value ="{{$row2->degree_id}}" {{Input::get('degree_id')==$row2->degree_id?'selected':''}}> 
                                    {{$row2->degree_name}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label >อาจารย์ :</label>
                            <select style="width:150px;" name="teach_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($teach as $index => $teacher)
                                <option value ="{{$teacher->teach_id}}" {{Input::get('teach_id')==$teacher->teach_id?'selected':''}}> 
                                    {{$teacher->first_name}} {{$teacher->last_name}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">ข้อมูลกลุ่มเรียน</a></button> -->
        </div> 

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    รายการข้อมูลกลุ่มเรียน
                    <a href="/studygroup/create" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มข้อมูลกลุ่มเรียน</a>
                </div>
                <div class="panel-body">  
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>กลุ่มเรียน</th>
                                <th>วัน/เดือน/ปี ที่เข้า</th>
                                <th>สาขา</th>
                                <th>ระดับ</th>
                                <th>อาจารย์</th>
                                <th style="width:110px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($group as $index => $row)
                        <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$row->group_name}}</td>
                                <td>{{$row->year}}</td>
                                <td>{{$row->bran_name}}</td>
                                <td>{{$row->degree_name}}</td>
                                <td>{{$row->first_name}} {{$row->last_name}}</td>
                                <td>
                                    <div class="btn-group">
                                       <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/studygroup/{{$row->group_id}}"></a>
                                       <!-- <a class="fa fa-trash delete-group btn btn-danger" aria-hidden="true" href="/studygroup/{{$row->group_id}}"></a> -->
                                       <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/studygroup/{{$row->group_id}}"></a>
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
