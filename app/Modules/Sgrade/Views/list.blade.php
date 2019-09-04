@extends('academic-layout') 
@section('title','รายเกรดตามห้องเรียน')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                ค้นหา
                </div>
                <div class="panel-body">
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                รายเกรดตามห้องเรียน
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ชื่อ-สกุล</th>
                                <th>ห้อง</th>
                                <th>วิชา</th>
                                <th>คะแนน</th>
                                <th>เกรด</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($sgrade as $grade)
                            <tr>
                                <td>{{$grade->first_name}} {{$grade->last_name}}</td>
                                <td>{{$grade->group_name}}</td>
                                <td>{{$grade->sub_code}} {{$grade->sub_name}}</td>
                                <td>{{$grade->score}}</td>
                                <td>{{$grade->grade}}</td>
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