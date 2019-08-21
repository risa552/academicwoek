@extends('academic-layout') 
@section('title','ข้อมูลแผนการเรียน')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาแผนการเรียน</div>
                <div class="panel-body">
                    <form action="/educate">
                    <div class="form-group">
                        <label >ภาคเรียน:</label>
                        <select style="width:150px;" name="term_id">
                            <option value="all">
                                ทั้งหมด
                            </option>
                        @foreach($term as $index => $row1)
                            <option value ="{{$row1->term_id}}" {{Input::get('term_id')==$row1->term_id?'selected':''}}> 
                                {{$row1->term_name}}/{{$row1->year}}
                            </option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label >อาจารย์:</label>
                        <select style="width:150px;" name="teach_id">
                            <option value="all">
                                ทั้งหมด
                            </option>
                        @foreach($teachers as $index => $row2)
                            <option value ="{{$row2->teach_id}}" {{Input::get('teach_id')==$row2->teach_id?'selected':''}}>
                                {{$row2->first_name}} {{$row2->last_name}}
                            </option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label >วิชา:</label>
                        <select style="width:150px;" name="sub_id">
                            <option value="all">
                                ทั้งหมด
                            </option>
                        @foreach($sub as $index => $row3)
                            <option value ="{{$row3->sub_id}}" {{Input::get('sub_id')==$row3->sub_id?'selected':''}}>
                                {{$row3->sub_name}}
                            </option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label >สาขา:</label>
                        <select style="width:150px;" name="bran_id">
                            <option value="all">
                                ทั้งหมด
                            </option>
                        @foreach($bran as $index => $row4)
                            <option value ="{{$row4->bran_id}}" {{Input::get('bran_id')==$row4->bran_id?'selected':''}}>
                                {{$row4->bran_name}}
                            </option>
                        @endforeach
                        </select>
                    </div>
                        <button type="submit" class="btn btn-default">ยืนยัน</button>
                    </form>
                </div>
            </div>
        </div> 

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    รายการข้อมูลภาระการสอน
                </div>
                <div class="panel-body">  
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>อาจารย์</th>
                                <th>วิชา</th>
                                <th>ภาคเรียน</th>
                                <th>สาขา</th>
                                <th style="width:150px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $index => $row)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$row->first_name}} {{$row->last_name}}</td>
                                    <td>{{$row->sub_code}} {{$row->sub_name}}</td>
                                    <td>{{$row->term_name}}/{{$row->year}}</td>
                                    <td>{{$row->bran_name}}</td>
                                    
                                    <!--<td>{{$row->first_name}} {{$row->last_name}}</td>
                                    <td>{{$row->sub_code}} {{$row->sub_name}}</td>
                                    <td>{{$row1->term_name}}/{{$row1->year}}</td>-->
                                    <td>
                                        <div class="btn-group">
                                            <a class="fa fa-file-text-o btn btn-success" aria-hidden="true" href="#"></a>
                                            <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/educate/{{$row->program_id}}"></a>
                                            <!--<a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/educate/{{$row->educate_id}}"></a>-->
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
        <div class="panel panel-default">
                <div class="panel-body">
                    <p style="padding-left:450px;">มหาวิทยาลัยราชมงคลสุวรรณภูมิ ศูนย์นนทบุรี</p>
                    <p style="padding-left:400px;">บัญชีภาระการสอนส่วนบุคคลสาขาวิชาสารสนเทศและคอมพิวเตอร์ธูรกิจ</p>
                    <p style="padding-left:450px;">ประจำภาคการศึกษาที่ {{$row1->term_name}}ปีการศึกษา {{$row1->year}} </p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="height:28px; width:40px;">ลำดับ</th>
                                <th style="height:25px; width:40px; padding-right:250px;">อาจารย์</th>
                                <th style="height:25px; width:100px;">รหัสวิชา</th>
                                <th>วิชา</th>
                                <th>ป.ตรี</th>
                                <th>ปวส.</th>
                                <th>ชม.ทฤษฏี</th>
                                <th>ชม.ปฏิบัติ</th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $index => $row)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$row->first_name}} {{$row->last_name}}</td>
                                <td>{{$row->sub_code}}</td>
                                <td> {{$row->sub_name}}</td>
                                <td></td>
                                <td></td>
                                <td> {{$row->theory}}</td>
                                <td> {{$row->practice}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <a  class="btn btn-default fa fa-print pull-right" aria-hidden="true"></a>
                </div>
            </div>
        </div>
    </div>  
</div>
@endsection