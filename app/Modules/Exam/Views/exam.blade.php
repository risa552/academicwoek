@extends('academic-layout') 
@section('title','การส่งข้อสอบ')
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
                <span class="breadcrumb__point" aria-current="page">ข้อมูลการส่งข้อมอบ</span>
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
                <div class="panel-heading">ค้นหาข้อมูลข้อสอบ</div>
                <div class="panel-body">
                    <form action="/exam">
                    <div class="form-group">
                            <label >วิชา:</label>
                            <select class="form-control" name="sub_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($items as $index => $row1)
                                <option value ="{{$row1->sub_id}}" {{Input::get('sub_id')==$row1->sub_id?'stlected':''}}>
                                    {{$row1->sub_name}} {{$row1->sub_name_eng}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label >อาจารย์:</label>
                            <select class="form-control" name="teach_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($teachs as $index => $teach)
                                <option value ="{{$teach->teach_id}}" {{Input::get('teach_id')==$teach->teach_id?'stlected':''}}>
                                    {{$teach->first_name}} {{$teach->last_name}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">ส่งข้อสอบ</a></button> -->
        </div> 
        <div class="col-md-10">
            <div class="panel panel-info">
                <div class="panel-heading">
                รายการการส่งข้อสอบ
              <!-- <a href="/exam/create" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> ส่งข้อสอบ</a> -->
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>รหัสวิชา</th>
                                <th>ชื่อวิชา</th>
                                <th>ไฟล์ข้อสอบกลางภาค</th>
                                <th>ไฟล์ข้อสอบปลายภาค</th>
                               <!-- <th style="width:50px">แก้ไขรายการ</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($exam as $index => $row)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td style="white-space: nowrap; overflow:hidden; text-overflow:ellipsis">{{$row->sub_code}}</td>
                                <td style="white-space: nowrap; overflow:hidden; text-overflow:ellipsis">{{$row->sub_name}} <br> {{$row->sub_name_eng}} <br> {{$row->first_name}} {{$row->last_name}} </td>
                                <td><a target="_blank" href="{{$row->file_mid}}">{{$row->file_mid}} <br> {{$row->created_at}}</a></td>
                                <td><a target="_blank" href="{{$row->file_final}}">{{$row->file_final}} <br> {{$row->created_at}}</a></td>
                                
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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