@extends('academic-layout') 
@section('title','ภาระการสอน')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาข้อมูลภาระการสอน</div>
                <div class="panel-body">
                    <form action="/pedagogy">
                    <div class="form-group">
                            <label >อาจารย์:</label>
                            <select name="teacher">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($rom as $index => $row2)
                                <option value ="{{$row2->teach_id}}" {{Input::get('teach_id')==$row2->teach_id?'selected':''}}>
                                    {{$row2->first_name}} {{$row2->last_name}}
                                </option>
                            @endforeach
                            </select>
                    </div>
                        <button type="submit" class="btn btn-default">ยืนยัน</button>
                    </form>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">อาจารย์</a></button> -->
        </div> 
        <form class="form-ajax" method="POST" action="/pedagogy">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    รายการการออกเกรด
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>ชื่ออาจารย์</th>
                                    <th>รหัสวิชา</th>
                                    <th>ชื่อวิชา</th>
                                    <th>กลุ่มเรียน</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($pedagogy as $index => $row)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$row->first_name}} {{$row->last_name}}</td>
                                    <td>{{$row->sub_code}}</td>
                                    <td>{{$row->sub_name}}</td>
                                    <td>{{$row->group_name}}</td>
                                    <td>
                                    <input type="text" value="{{$row->pedagogy}}">
                                    <body onLoad="window.print()">
                                    </td>
                                    <td><input type="text"/></td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
        
    </div>  
</div>

@endsection
