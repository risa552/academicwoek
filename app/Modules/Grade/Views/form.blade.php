@extends('academic-layout') 
@section('title','ข้อมูลออกเกรด')
@section('content')
div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">  
                <div class="panel-heading">
                ออกเกรด
                </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>วิชา</th>
                                <th>นักศึกษา</th>
                                <th>เกรด</th>
                                <th style="width:110px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($grade as $index => $row)
                            <tr>
                                <td>{{$row->sub_name}}</td>
                                <td>{{$row->first_name}} {{$row->last_name}}</td>
                                <td></td>
                                <td>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
     @endsection



                   