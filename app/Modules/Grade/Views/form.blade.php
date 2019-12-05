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
                            <select class="form-control" name="sub_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($rom1 as $index => $row3)
                                <option value ="{{$row3->sub_id}}" {{Input::get('sub_id')==$row3->sub_id?'selected':''}}>
                                    {{$row3->sub_name}} {{$row3->sub_name_eng}}
                                </option>
                            @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                            <label >กลุ่มเรียน:</label>
                            <select class="form-control" name="group_id">
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
                                    <th>รายงาน</th>
                                   <!-- <th>คะแนน/เกรด</th> -->
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $index => $row)
                                <tr>
                                    <td>{{$index+$items->firstItem()}}</td>
                                    <td>{{$row->group_name}}</td>
                                    <td>{{$row->sub_code}} {{$row->sub_name}} <br> {{$row->sub_name_eng}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="fa fa-list-alt btn btn-default" aria-hidden="true" href="/grade/{{$row->educate_id}}"></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $items->render() !!}
                    </div>
                </div>
            </div>
        </form>
        
    </div>  
</div>

@endsection
