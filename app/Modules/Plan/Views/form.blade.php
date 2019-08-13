@extends('academic-layout') 
@section('title','แผนการเรียน')
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
        <form class="form-ajax" method="POST" action="/plan">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                   
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>รหัสวิชา</th>
                                    <th>ชื่อวิชา</th>
                                    <th>หน่อยกิต </th>
                                    <th>ชั่วโมงทฤษฎี</th>
                                    <th>ชั่วโมงปฎิบัติ</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($plan as $index => $row)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$plan->sub_code}}</td>
                                    <td>{{$plan->sub_name}}</td>
                                    <td>{{$plan->credit}}</td>
                                    <td>{{$plan->theory}}</td>
                                    <td>{{$plan->practice}}</td>
                                    <td>
                                    <input type="text" value="{{$row->plan}}">
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
