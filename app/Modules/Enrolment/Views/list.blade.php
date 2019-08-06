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
                    <div>
                   <label >ชื่อนักศึกษา:</label>
                                <select name="std_id">
                                    <option value="all">
                                        ทั้งหมด
                                    </option>
                                @foreach($student as $index => $row1)
                                    <option value ="{{$row1->std_id}}" {{Input::get('std_id')==$row1->std_id?'stlected':''}}>
                                        {{$row1->first_name}} {{$row1->last_name}}
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
                    <form action="/enrolment">
                   <div>
                        <label >ชื่อนักศึกษา:</label>
                                <select name="std_id">
                                    <option value="all">
                                        ทั้งหมด
                                    </option>
                                @foreach($student as $index => $row1)
                                    <option value ="{{$row1->std_id}}" {{Input::get('std_id')==$row1->std_id?'stlected':''}}>
                                        {{$row1->first_name}} {{$row1->last_name}}
                                    </option>
                                @endforeach
                                </select>
                        <button type="submit" class="btn btn-default">ยืนยัน</button>

                    </div>
                    </form>
                </div>
                    <div class="panel-body">  
                         <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>รหัสนักศึกษา</th>
                                <th>ชื่อนักศึกษา</th>
                                <th>วิชา</th>
                                <th>เกรด</th>
                                <th>สถานะ</th>
                                <th>แผนการเรียน</th>
                                <th style="width:110px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $index => $row)
                        <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$row->number}}</td>
                                <td>{{$row->first_name}} {{$row->last_name}}</td>
                                <td>{{$row->sub_name}}</td>
                                <td>{{$row->grade}}</td>
                                <td>{{$row->status}}</td>
                                <td>{{$row->program_id}}</td>
                                <td>
                                    <div class="btn-group">
                                       <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/enrolment/{{$row->enro_id}}"></a>
                                       <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/enrolment/{{$row->enro_id}}"></a>
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
