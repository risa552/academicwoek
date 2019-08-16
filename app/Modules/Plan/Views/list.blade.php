@extends('academic-layout') 
@section('title','รายงานแผนการเรียน')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาข้อมูลแผนการเรียน</div>
                <div class="panel-body">
                    <form action="/plan">
                    <div class="form-group">
                            <label >ภาคเรียน:</label>
                            <select name="term"์>
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($term as $index => $row2)
                                <option value ="{{$row2->term_id}}" {{Input::get('term_id')==$row2->term_id?'selected':''}}>
                                    {{$row2->term_name}}/{{$row2->year}}
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
        <form class="form-ajax" method="POST" action="/plan">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                     รายงานภาระการสอน
                    <a href="#" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มข้อมูลภาระการสอน</a>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>อาจารย์</th>
                                    <th>วิชา</th>
                                    <th>ภาคเรียน</th>
                                    <th style="width:150px">แก้ไขรายการ</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $index => $row)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    
                                    <td>{{$row->first_name}} {{$row->last_name}}</td>
                                    <td>{{$row->sub_code}} {{$row->sub_name}}</td>
                                    <td>{{$row2->term_name}}/{{$row2->year}}</td>
                                    <td>
                                        <a class="fa fa-file-text-o btn btn-success" aria-hidden="true" href="#"></a>
                                            <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="#"></a>
                                            <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="#"></a>
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
