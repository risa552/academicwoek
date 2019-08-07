@extends('academic-layout') 
@section('title','ข้อมูลลงทะเบียน')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาข้อมูลลงทะเบียน</div>
                <div class="panel-body">
                    <form action="/enrolment">
                        <div class="form-group">
                            <label>ชื่อนักศึกษา</label>
                            <input type="text" class="form-control" name="keyword" value="{{Input::get('keyword')}}">
                        </div>
                        <div>
                                <label >ภาคเรียน:</label>
                                <select name="term_id">
                                    <option value="all">
                                        ทั้งหมด
                                    </option>
                                @foreach($terms as $index => $row3)
                                    <option value ="{{$row3->term_id}}" {{Input::get('term_id')==$row3->term_id?'stlected':''}}>
                                        {{$row3->term_name}}/{{$row3->year}}
                                    </option>
                                @endforeach
                                </select>
                        </div>
                        <div>
                                <label >สาขา:</label>
                                <select name="term_id">
                                    <option value="all">
                                        ทั้งหมด
                                    </option>
                                @foreach($terms as $index => $row3)
                                    <option value ="{{$row3->term_id}}" {{Input::get('term_id')==$row3->term_id?'stlected':''}}>
                                        {{$row3->term_name}}/{{$row3->year}}
                                    </option>
                                @endforeach
                                </select>
                        </div>
                        <button type="submit" class="btn btn-default">ยืนยัน</button>
                    </form>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">ข้อมูลลงทะเบียน</a></button> -->
        </div> 

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                รายการข้อมูลลงทะเบียน
                </div>
        <div class="panel-body">  
            <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>รหัสนักศึกษา</th>
                                <th>ชื่อนักศึกษา</th>
                                <th style="width:150px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $index => $row)
                        <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$row->number}}</td>
                                <td>{{$row->first_name}} {{$row->last_name}}</td>
                                <td>
                                    <div class="btn-group">
                                       <a class="fa fa-file-text-o btn btn-success" aria-hidden="true" href="#"></a>
                                       <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="#"></a>
                                       <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="#"></a>
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
