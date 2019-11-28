@extends('academic-layout') 
@section('title','รายงานการลงทะเบียน')
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
                <li class="breadcrumb__group">
                <a href="/enrolment" class="breadcrumb__point r-link">ลงทะเบียน</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li>
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">รายงานลงทะเบียน</span>
                </li>
            </ol>
            </nav>
        </div>
    <div>
</div>
<div class="container">
    <div class="row" >
        <form class="form-ajax" method="POST" action="/plan">
            <div class="col-md-9"  >
                <div class="panel panel-info">
                    <div class="panel-heading">
                    <a href="/enrolment"><i class="fa fa-arrow-left" aria-hidden="true"></i> กลับ</a>
                     รายงานการลงทะเบียน : รหัส {{$student->number}} ชื่อ {{$student->first_name}} {{$student->last_name}} 
                    <a href="/plan/create?std_id={{$student->std_id}}" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มรายวิชา</a>
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
                                    <td> {{$item->term_name}}/{{$item->term_year}}</td>
                                    <td> {{$item->sub_code}} {{$item->sub_name}}<br>{{$item->sub_name_eng}}</td>
                                    <td> {{$item->status}}</td>
                                    <td> {{$item->grade}}</td>
                                    <td>
                                        <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/editplan/{{$item->enro_id}}"></a>
                                        <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/plan/{{$item->enro_id}}"></a>
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
