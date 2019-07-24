@extends('academic-layout') 
@section('title','ข้อมูลกลุ่มวิชา')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหากลุ่มวิช</div>
                <div class="panel-body">
                    <form action="/subjectgroup">
                        <div class="form-group">
                            <label for="keyword">กลุ่มวิชา</label>
                            <input type="text"  name="keyword" class="form-control" value="{{Input::get('keyword')}}" >
                        </div>
                        <button type="submit" class="btn btn-default">ยืนยัน</button>
                    </form>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">ข้อมูลกลุ่มวิชา</a></button> -->
        </div> 
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    รายการข้อมูลกลุ่มวิชา
                    <a href="/subjectgroup/create" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มข้อมูลกลุ่มวิชา</a>
                </div>
                <div class="panel-body">  
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>ชื่อกลุ่มวิชา</th>
                                <th style="width:110px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($subjectgroup as $index => $subgroup)
                          <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$subgroup->subgroup_name}}</td>
                            <td>
                                <div class="btn-group">
                                       <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/subjectgroup/{{$subgroup->subgroup_id}}"></a>
                                       <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/subjectgroup/{{$subgroup->subgroup_id}}"></a>
                                </div>
                            </td>
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
