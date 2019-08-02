@extends('academic-layout') 
@section('title','ออกเกรด')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาข้อมูลภาคเรียน</div>
                <div class="panel-body">
                    <form action="/grade">
                    <div class="form-group">
                            <label >ภาคเรียน:</label>
                            <select name="term_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($rom as $index => $row2)
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
        <form class="form-ajax" method="POST" action="/grade">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    รายการการออกเกรด
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>วิชา</th>
                                    <th>นักศึกษา</th>
                                    <th>เกรด</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($grade as $index => $row)
                                <tr>
                                    <td>{{$row->sub_code}}</td>
                                    <td>{{$row->first_name}} {{$row->last_name}}</td>
                                    <td>
                                    <input type="text" value="{{$row->grade}}" name="grade[{{$row->enro_id}}]"/>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <button class="bth" style="margin-left:700px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                    </div>
                </div>
            </div>
        </form>
        
    </div>  
</div>

@endsection
