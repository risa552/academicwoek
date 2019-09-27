@extends('academic-layout') 
@section('title',' วิชา')
@section('content')
<div class="container">
    <div class="col-md-10">
        <div class="page__section">
            <nav class="breadcrumb breadcrumb_type5" aria-label="Breadcrumb">
            <ol class="breadcrumb__list r-list">
                <li class="breadcrumb__group">
                <a href="/" class="breadcrumb__point r-link"><i class="fa fa-home" aria-hidden="true"></i></a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                <!-- </li>
                <li class="breadcrumb__group">
                <a href="/professor" class="breadcrumb__point r-link">ข้อมูลอาจารย์</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li> -->
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">ข้อมูลวิชา</span>
                </li>
            </ol>
            </nav>
        </div>
    <div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <div class="panel panel-info">
                <div class="panel-heading">ค้นหาข้อมูลวิชา</div>
                <div class="panel-body">
                    <form action="/subject">
                        <div class="form-group">
                            <label>ชื่อวิชา</label>
                            <input type="text" name="keyword" class="form-control" value="{{Input::get('keyword')}}" >
                        </div>
                        <div class="form-group">
                            <label >กลุ่มวิชา:</label>
                            <select style="width:150px;" name="subgroup_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($items2 as $index => $row1)
                                <option value ="{{$row1->subgroup_id}}" {{Input::get('subgroup_id')==$row1->subgroup_id?'selected':''}}>
                                    {{$row1->subgroup_name}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">วิชา</a></button> -->
        </div> 

        <div class="col-md-10">
            <div class="panel panel-info">
                <div class="panel-heading">
                    รายการข้อมูลวิชา
                    <a href="/subject/create" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มข้อมูลวิชา</a>
                </div>
                <div class="panel-body">
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>รหัสวิชา</th>
                                <th>ชื่อวิชา</th>
                                <th>หน่วยกิต</th>
                                <!-- <th>ชั่วโมงปฎิบัติ</th>
                                <th>ชั่วโมงทฤษฎี</th>
                                <th>ศึกษาเพิ่มเติม</th> -->
                                <th>กลุ่มวิชา</th>
                                <th style="width:110px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $index =>$row)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$row->sub_code}}</td>
                                <td>{{$row->sub_name}} <br> {{$row->sub_nameeng}}</td>
                                <td>{{$row->credit}}({{$row->theory}}-{{$row->practice}}-{{$row->special}})</td>
                                <!-- <td>{{$row->theory}}</td>
                                <td>{{$row->practice}}</td>
                                <td>{{$row->special}}</td> -->
                                <td>{{$row->subgroup_name}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/subject/{{$row->sub_id}}"></a>
                                        <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/subject/{{$row->sub_id}}"></a>
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
    </div>  
</div>
@endsection
