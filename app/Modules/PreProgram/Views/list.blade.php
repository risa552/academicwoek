@extends('academic-layout') 
@section('title','เพิ่มการลงทะเบียน')
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
                <span class="breadcrumb__point" aria-current="page">ข้อมูลแผนการเรียน</span>
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
                <div class="panel-heading">ค้นหาแผนการเรียน</div>
                <div class="panel-body">
                    <form action="/preprogram">
                        <div class="form-group">
                            <label >ปีการศึกษา:</label>
                            <select class="form-control" name="year_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($years as $index => $year)
                                <option value ="{{$year->year_id}}" {{Input::get('year_id')==$year->year_id?'selected':''}}> 
                                    {{$year->year_name}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label >หลักสูตร:</label>
                            <select class="form-control" name="cou_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($courses as $index => $cou)
                                <option value ="{{$cou->cou_id}}" {{Input::get('cou_id')==$cou->cou_id?'selected':''}}> 
                                    {{$cou->cou_name}}
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
                    รายการข้อมูลแผนการเรียน
                    <a href="/preprogram/create" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มข้อมูลแผนการเรียน</a>
                </div>
                <div class="panel-body">  
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <!-- <th>กลุ่มเรียน</th> -->
                                <th>ปีการศึกษา</th>
                                <th>หลักสูตร</th>
                                <th>สาขา</th>
                                <th style="width:150px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $index => $row)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$row->year_name}}</td>
                                    <td>{{$row->cou_name}}</td>
                                    <td>{{$row->bran_name}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="fa fa-file-text-o btn btn-success" aria-hidden="true" href="/detail-report/{{$row->program_id}}/{{$row->bran_id}}"></a>
                                            <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/preprogram/{{$row->program_id}}"></a>
                                            <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/preprogram/{{$row->program_id}}"></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $items->render() !!}
                    <!--<ul class="pagination">
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                    </ul> -->
                </div>
            </div>
        </div>
    </div>  
</div>

@endsection