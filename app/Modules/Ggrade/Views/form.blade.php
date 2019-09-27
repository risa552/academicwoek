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
                    <form action="/ggrade">
                    <div class="form-group">
                        <label for="keyword">ชื่อนักศึกษา</label>
                        <input type="text" name="keyword" class="form-control" value="{{Input::get('keyword')}}" >
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
                    <div class="form-group">
                        <label >ชื่อวิชา:</label>
                        <select  style="width:150px;" name="sub_id">
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
             รายงานเกรดนักศึกษา <!--: {{$row3->sub_name}}     -->
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>ชื่อวิชา</th>
                                    <th>นักศึกษา</th>
                                    <th>กลุ่มเรียน</th>
                                    <th>เกรด</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($ggrade as $index => $row)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$row->sub_name}}</td>
                                    <td>{{$row->first_name}} {{$row->last_name}}</td>
                                    <td>{{$row->group_name}}</td>
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
