@extends('academic-layout') 
@section('title','รายเกรดตามห้องเรียน')
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
                <span class="breadcrumb__point" aria-current="page">รายเกรดตามห้องที่ปรึกษา</span>
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
                <div class="panel-heading">
                ค้นหา
                </div>
                <div class="panel-body">
                    <form action="/sgrade">
                        <!-- <div class="form-group">
                            <label>ชื่อนักศึกษา</label>
                            <input type="text" class="form-control" name="keyword" value="{{Input::get('keyword')}}">
                        </div> -->
                        <div class="form-group">
                                <label >กลุ่มเรียน:</label>
                                <select class="form-control" name="group_id">
                                    <option value="all">
                                        ทั้งหมด
                                    </option>
                                @foreach($studygroup as $index => $row2)
                                    <option value ="{{$row2->group_id}}" {{Input::get('group_id')==$row2->group_id?'stlected':''}}>
                                        {{$row2->group_name}}
                                    </option>
                                @endforeach
                                </select>
                        </div>
                        <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-info">
                <div class="panel-heading">
                รายเกรดตามห้องเรียน
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <!-- <th>รหัส</th>
                                <th>ชื่อ-สกุล</th> -->
                                <th>ห้อง</th>
                                <th>รายงาน</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($sgrade as $index=> $grade)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$grade->group_name}}</td>
                                <td>
                                    <div class="btn-group">
                                       <a class="fa fa-file-text-o btn btn-success" aria-hidden="true" href="/sgrade/{{$grade->group_id}}"></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection