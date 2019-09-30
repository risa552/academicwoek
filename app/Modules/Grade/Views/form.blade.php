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
            <div class="panel panel-info">
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
                                    {{$row3->sub_name}} {{$row3->sub_nameeng}}
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
                <div class="panel panel-info">
                    <div class="panel-heading">
                    รายการการออกเกรด
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>นักศึกษา</th>
                                    <th>ชื่อวิชา</th>
                                    <th>เกรด</th>
                                   <!-- <th>คะแนน/เกรด</th> -->
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($grade as $index => $row)
                                <tr>
                                    <td>{{$index+$grade->firstItem()}}</td>
                                    <td>{{$row->first_name}} {{$row->last_name}} [{{$row->group_name}}]</td>
                                    <td>{{$row->sub_code}} {{$row->sub_name}}</td>
                                    <td>
                                        <div class="form-group">
                                            <select class="form-control"  name="grade[{{$row->enro_id}}]">
                                            <option {{isset($row)&& $row->grade=='A'?' selected ':''}} value="A">A</option>
                                                <option {{isset($row)&& $row->grade=='B+'?'selected':''}} value="B+">B+</option>
                                                <option {{isset($row)&& $row->grade=='B'?'selected':''}} value="B">B</option>
                                                <option {{isset($row)&& $row->grade=='C+'?'selected':''}} value="C+">C+</option>
                                                <option {{isset($row)&& $row->grade=='C'?'selected':''}} value="C">C</option>
                                                <option {{isset($row)&& $row->grade=='D+'?'selected':''}} value="D+">D+</option>
                                                <option {{isset($row)&& $row->grade=='D'?'selected':''}} value="D">D</option>
                                                <option {{isset($row)&& $row->grade=='F'?'selected':''}} value="F">F</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <button tyep="button" class="pull-right">ยืนยัน </button>
                        {!! $grade->render() !!}
                    </div>
                </div>
            </div>
        </form>
        
    </div>  
</div>

@endsection
