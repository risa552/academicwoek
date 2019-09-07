@extends('academic-layout') 
@section('title','การส่งข้อสอบ')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาข้อมูลข้อสอบ</div>
                <div class="panel-body">
                    <form action="/exam">
                    <div class="form-group">
                                <label >วิชา:</label>
                                <select style="width:120px;" name="sub_id">
                                    <option value="all">
                                        ทั้งหมด
                                    </option>
                                @foreach($items as $index => $row1)
                                    <option value ="{{$row1->sub_id}}" {{Input::get('sub_id')==$row1->sub_id?'stlected':''}}>
                                        {{$row1->sub_name}}
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
            <div class="panel panel-default">
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
                                <td style="white-space: nowrap; overflow:hidden; text-overflow:ellipsis">{{$row->sub_name}} <br> {{$row->sub_nameeng}}</td>
                                <td><a target="_blank" href="{{$row->file_mid}}">{{$row->file_mid}} <br> {{$row->created_at}}</a></td>
                                <td><a target="_blank" href="{{$row->file_final}}">{{$row->file_final}} <br> {{$row->created_at}}</a></td>
                                <!--<td>
                                    <div class="btn-group">
                                        <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/exam/{{$row->exam_id}}"></a>
                                        <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/exam/{{$row->exam_id}}"></a>
                                    </div>
                                </td>-->
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