@extends('academic-layout') 
@section('title','รายงานการลงทะเบียน')
@section('content')
<div class="container">
    <div class="row" >
        <!-- <div class="col-md-2">
           
            <!--<button type="submit" class="btn btn-info"><a href="#">อาจารย์</a></button> 
        </div>  -->
        <form class="form-ajax" method="POST" action="/plan">
            <div class="col-md-9" style="magin:100px; auto;" >
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <a href="/enrolment"><i class="fa fa-arrow-left" aria-hidden="true"></i> กลับ</a>
                     รายงานการลงทะเบียน : รหัส {{$student->number}} ชื่อ {{$student->first_name}} {{$student->last_name}} 
                    <a href="/plan/create" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มรายวิชา</a>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ภาคเรียน</th>
                                    <th>วิชา</th>
                                    <th>สถานะ</th>
                                    <th>เกรด</th>
                                    <th>รายการแก้ไข</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                <tr>
                                    <td> {{$item->term_name}}/{{$item->year}}</td>
                                    <td> {{$item->sub_code}} {{$item->sub_name}}</td>
                                    <td> {{$item->status}}</td>
                                    <td> {{$item->grade}}</td>
                                    <td>
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
