@extends('academic-layout') 
@section('title','ข้อมูลแผนการเรียน')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาแผนการเรียน</div>
                <div class="panel-body">
                    <form action="/program">
                        <div class="form-group">
                            <label for="keyword">แผนการเรียน</label>
                            <input type="text" name="keyword" class="form-control" value="{{Input::get('keyword')}}">
                        </div>
                        <div class="form-group">
                            <label >สาขา:</label>
                            <select style="width:150px;" name="bran_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($items2 as $index => $row1)
                                <option value ="{{$row1->bran_id}}" {{Input::get('bran_id')==$row1->bran_id?'selected':''}}> 
                                    {{$row1->bran_name}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label >ภาคเรียน:</label>
                            <select style="width:150px;" name="term_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($items3 as $index => $row2)
                                <option value ="{{$row2->term_id}}" {{Input::get('term_id')==$row2->term_id?'selected':''}}>
                                    {{$row2->term_name}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label >วิชา:</label>
                            <select style="width:150px;" name="sub_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($items4 as $index => $row3)
                                <option value ="{{$row3->sub_id}}" {{Input::get('sub_id')==$row3->sub_id?'selected':''}}>
                                    {{$row3->sub_name}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default">ยืนยัน</button>
                    </form>
                </div>
            </div>
        </div> 

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    รายการข้อมูลแผนการเรียน
                    <a href="/program/create" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มข้อมูลแผนการเรียน</a>
                </div>
                <div class="panel-body">  
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>สาขา</th>
                                <th>ภาคเรียน</th>
                                <th>วิชา</th>
                                <th>คาบเรียน</th>
                                <th>ห้องเรียน</th>
                                <th style="width:110px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $index => $row)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$row->bran_name}}</td>
                                    <td>{{$row->term_name}}/{{$row->year}}</td>
                                    <td>{{$row->sub_name}}</td>
                                    <td>{{$row->class}}</td>
                                    <td>{{$row->room}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/program/{{$row->program_id}}"></a>
                                            <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/program/{{$row->program_id}}"></a>
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