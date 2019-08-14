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
                            @foreach($rom1 as $index => $row2)
                                <option value ="{{$row2->teach_id}}" {{Input::get('teach_id')==$row2->teach_id?'selected':''}}>
                                    {{$row2->first_name}} {{$row2->last_name}}
                                </option>
                            @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                            <label >ภาคเรียน:</label>
                            <select name="term_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($rom2 as $index => $row2)
                                <option value ="{{$row2->term_id}}" {{Input::get('term_id')==$row2->term_id?'selected':''}}>
                                    {{$row2->term_name}}
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
                    รายการข้อมูลภาระการสอน
                    <a href="/pedagogy/create" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> ข้อมูลภาระการสอน</a>
                </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>ชื่ออาจารย์</th>
                                    <th>รหัสวิชา</th>
                                    <th>ชื่อวิชา</th>
                                    <th>หน่วยกิต</th>
                                    <th>ชั่วโมงทฤษฎี</th>
                                    <th>ชั่วโมงปฎิบัติ</th>
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
                                    <td>{{$row->credit}}</td>
                                    <td>{{$row->theory}}</td>
                                    <td>{{$row->practice}}</td>
                                    <td>{{$row->group_name}}</td>
                                    <td>
                                    <div class="btn-group">
                                        <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/pedagogy/{{$row->educate_id}}"></a>
                                        <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/pedagogy/{{$row->educate_id}}"></a>
                                    </div>
                                    </td>
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
