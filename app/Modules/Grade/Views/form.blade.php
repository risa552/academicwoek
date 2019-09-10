@extends('academic-layout') 
@section('title','ออกเกรด')
@section('content')
<div class="container">
    <div class="col-md-10">
        <div class="page__section">
            <nav class="breadcrumb breadcrumb_type5" aria-label="Breadcrumb">
            <ol class="breadcrumb__list r-list">
                <li class="breadcrumb__group">
                <a href="/" class="breadcrumb__point r-link"><i class="fa fa-home" aria-hidden="true"></i></a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li>
                <!-- <li class="breadcrumb__group">
                <a href="/educate" class="breadcrumb__point r-link">ข้อมูลภาระการสอน</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li> -->
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">การออกเกรด</span>
                </li>
            </ol>
            </nav>
        </div>
    <div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาข้อมูลการออกเกรด</div>
                <div class="panel-body">
                    <form action="/grade">
                    <div class="form-group">
                            <label >ชื่อวิชา:</label>
                            <select style="width:150px;" name="sub_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($rom1 as $index => $row3)
                                <option value ="{{$row3->sub_id}}" {{Input::get('sub_id')==$row3->sub_id?'selected':''}}>
                                    {{$row3->sub_name}}
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
                            @foreach($rom as $index => $row2)
                                <option value ="{{$row2->term_id}}" {{Input::get('term_id')==$row2->term_id?'selected':''}}>
                                    {{$row2->term_name}}
                                </option>
                            @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                            <label >กลุ่มเรียน:</label>
                            <select name="group_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($rom2 as $index => $row4)
                                <option value ="{{$row4->group_id}}" {{Input::get('group_id')==$row4->group_id?'selected':''}}>
                                    {{$row4->group_name}}
                                </option>
                            @endforeach
                            </select>
                    </div>
                        <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
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
                                    <th>รหัสวิชา</th>
                                    <th>ชื่อวิชา</th>
                                    <th>นักศึกษา</th>
                                    <th>คะแนน/เกรด</th>
                                   <!-- <th>คะแนน/เกรด</th> -->
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($grade as $index => $row)
                                <tr>
                                    <td>{{$row->sub_code}}</td>
                                    <td>{{$row->sub_name}}</td>
                                    <td>{{$row->first_name}} {{$row->last_name}}</td>
                                    <td>
                                        <input type="text" value="{{$row->score}}" name="score[{{$row->enro_id}}]"  style="width:100px;" class="score-grade"/>
                                        <input type="text" readonly style="width:100px;" value="{{$row->grade}}" name="grade[{{$row->enro_id}}]" class="grade-input"/>
                                    </td>
                                    <!--<td>
                                    <input type="text" style="width:100px;" value="{{$row->grade}}" name="grade[{{$row->enro_id}}]"/>
                                    </td>-->
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
