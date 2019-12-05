@extends('academic-layout') 
@section('title','รายงานเกรด กลุ่มเรียน')
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
                <span class="breadcrumb__point" aria-current="page">รายงานเกรดตามวิชา</span>
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
                <div class="panel-heading">ค้นหาข้อมูลกลุ่มเรียน</div>
                <div class="panel-body">
                    <form action="/ggrade/{{$educate_id}}">
                    <div class="form-group">
                        <label for="keyword">ชื่อนักศึกษา</label>
                        <input type="text" name="keyword" class="form-control" value="{{Input::get('keyword')}}" >
                    </div>
                    
                  
                        <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">เกรด กลุ่มเรียน</a></button> -->
        </div> 
        <form class="form-ajax" method="POST" action="/plan">
            <div class="col-md-9">
                <div class="panel panel-info">
                    <div class="panel-heading">
             รายงานเกรดวิชา : {{$subject->sub_name}}   กลุ่มเรียน :  {{$subject->group_name}} 
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>นักศึกษา</th>
                                    <th>เกรด</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($ggrade as $index => $row)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$row->first_name}} {{$row->last_name}}</td>
                                    <td>{{$row->grade}}</td>
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
