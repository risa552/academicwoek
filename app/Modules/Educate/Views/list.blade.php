@extends('academic-layout') 
@section('title','ข้อมูลภาระการสอน')
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
                <span class="breadcrumb__point" aria-current="page">ข้อมูลภาระการสอน</span>
                </li>
            </ol>
            </nav>
        </div>
    <div>
</div>
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
                   <!-- <div class="form-group">
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
                    </div>-->
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
                        <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
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
                                <th>แก้ไขรายการ</th>
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
                                            <!-- <a class="fa fa-file-text-o btn btn-success" aria-hidden="true" href="#"></a> -->
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
                    <p style="text-align:center;">มหาวิทยาลัยราชมงคลสุวรรณภูมิ ศูนย์นนทบุรี</p>
                    <p style="text-align:center;">บัญชีภาระการสอนส่วนบุคคลสาขา </p>
                    <p style="text-align:center;">ประจำภาคการศึกษาที่  ปีการศึกษา </p>
                    <p style="text-align:center;">(จำนวนคาบต่อสัปดาห์ ท = ทฤษฏี, ป = ปฏิบัติ)</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th rowspan=4 style="text-align:center;">ลำดับ</th>
                                <th rowspan=4 style="text-align:center;padding-right:100px;">อาจารย์</th>
                                <th colspan=2 rowspan=2 style="text-align:center;">รายวิชา</th>
                                <th colspan=2 rowspan=2 style="text-align:center;">ห้องเรียน</th>
                                <th colspan=12  style="text-align:center;">จำนวนคาบ</th>
                                <th rowspan=4 >ลายเซ็นรับทราบ</th>
                                <th rowspan=4>วดป.ส่งข้อสอบกลางภาค</th>
                                <th rowspan=4>วดป.ส่งข้อสอบปลายภาค</th>
                            </tr>
                            <tr>
                                <th colspan=4 style="text-align:center;">รอบเช้า</th>
                                <th colspan=4 style="text-align:center;">สมทบ</th>
                                <th colspan=4 style="text-align:center;">รวมทั้งสิ้น</th>
                            </tr>
                            <tr>
                                <th rowspan=2 style="height:25px; width:100px;">รหัสวิชา</th>
                                <th rowspan=2>วิชา</th>
                                <th rowspan=2>ป.ตรี</th>
                                <th rowspan=2>ปวส.</th>
                                <th rowspan=2>ท</th>
                                <th rowspan=2>ป</th>
                                <th colspan=2 style="text-align:center;">รวม</th>
                                <th rowspan=2>ท</th>
                                <th rowspan=2>ป</th>
                                <th colspan=2 style="text-align:center;">รวม</th>
                                <th rowspan=2>ท</th>
                                <th rowspan=2>ป</th>
                                <th colspan=2 style="text-align:center;">รวม</th>
                            </tr>
                            <tr>
                                
                                <th>ปวส.</th>
                                <th>ป.ตรี</th>
                                <th>ปวส.</th>
                                <th>ป.ตรี</th>
                                <th>ปวส.</th>
                                <th>ป.ตรี</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $index => $roww)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$roww->first_name}} {{$roww->last_name}}</td>
                                <td>{{$roww->sub_code}}</td>
                                <td>{{$roww->sub_name}}</td>
                                <td>{{$roww->group_name}}</td>
                                <td>{{$roww->group_name}} </td>
                                <!-- <td>{{$roww->theory}}</td>
                                <td>{{$roww->practice}}</td>
                                <td>({{$roww->theory}}+{{$roww->practice}})</td>
                                <td>({{$roww->theory}}+{{$roww->practice}})</td>
                                <td>{{$roww->theory}}</td>
                                <td>{{$roww->practice}}</td>
                                <td>({{$roww->theory}}+{{$roww->practice}})</td>
                                <td>({{$roww->theory}}+{{$roww->practice}})</td>
                                <td>{{$roww->theory}}</td>
                                <td>{{$roww->practice}}</td>
                                <td>({{$roww->theory}}+{{$roww->practice}})</td>
                                <td>({{$roww->theory}}+{{$roww->practice}})</td> -->
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
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