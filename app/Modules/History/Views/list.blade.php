@extends('academic-layout') 
@section('title','ข้อมูลส่วนตัว')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel-body">
                <table class="table table-bordered" style="border: 3px solid #ddd;">
                    <tbody >
                    @foreach($history as $index => $his)
                        <tr>
                            <td style="width:150px;"><b>รหัสนักศึกษา</b></td>
                            <td>{{$his->number}}</td>
                        </tr>
                        <tr>
                            <td style="width:150px;"><b>ชื่อนักศึกษา</b></td>
                            <td>{{$his->first_name}} {{$his->last_name}}</td>
                        </tr>
                        <tr>
                            <td style="width:150px;"><b>ข้อมูลระดับ</b></td>
                            <td>{{$his->degree_name}}</td>
                        </tr>
                        <tr>
                            <td style="width:150px;"><b>ข้อมูลสาขา</b></td>
                            <td>{{$his->bran_name}}</td>
                        </tr>
                        <tr>
                            <td style="width:150px;"><b>ข้อมูลหลักสูตร</b></td>
                            <td>{{$his->cou_name}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
           </div>
        </div>
    </div>  
</div>

@endsection
