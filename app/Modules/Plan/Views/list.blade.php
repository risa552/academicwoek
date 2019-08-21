@extends('academic-layout') 
@section('title','รายงานภาระการสอน')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาข้อมูลภาระการสอน</div>
                <div class="panel-body">
                    <form action="/plan">
                    <div class="form-group">
                            <label >ภาคเรียน:</label>
                            <select name="term_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($term as $index => $row2)
                                <option value ="{{$row2->term_id}}" {{Input::get('term_id')==$row2->term_id?'selected':''}}>
                                    {{$row2->term_name}}/{{$row2->year}}
                                </option>
                            @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        <label >สาขา:</label>
                        <select name="bran_id">
                            <option value="all">
                                ทั้งหมด
                            </option>
                        @foreach($bran as $index => $row3)
                            <option value ="{{$row3->bran_id}}" {{Input::get('bran_id')==$row3->bran_id?'selected':''}}>
                                {{$row3->bran_name}}
                            </option>
                        @endforeach
                        </select>
                    </div>
                        <button type="submit" class="btn btn-default">ยืนยัน</button>
                    </form>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">อาจารย์</a></button> -->
        </div> 
        <form class="form-ajax" method="POST" action="/plan">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <!--<div class="panel-heading">
                     รายงานภาระการสอน
                   <!-- <a href="#" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มข้อมูลภาระการสอน</a>
                    </div>-->
                    <div class="panel-body">
                        <p style="padding-left:250px;">มหาวิทยาลัยราชมงคลสุวรรณภูมิ ศูนย์นนทบุรี</p>
                        <p style="padding-left:150px;">บัญชีภาระการสอนส่วนบุคคลสาขาวิชาสารสนเทศและคอมพิวเตอร์ธูรกิจ</p>
                        <p style="padding-left:250px;">ประจำภาคการศึกษาที่ {{$row2->term_name}}ปีการศึกษา {{$row2->year}} </p>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="height:28px; width:40px;">ลำดับ</th>
                                    <th style="height:25px; width:40px; padding-right:150px;">อาจารย์</th>
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
                                    <td>คธ.16021N</td>
                                    <td> {{$row->theory}}</td>
                                    <td> {{$row->practice}}</td>
                                    <!--<td>
                                        <a class="fa fa-file-text-o btn btn-success" aria-hidden="true" href="#"></a>
                                            <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="#"></a>
                                            <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="#"></a>
                                   </td>-->
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <a  class="btn btn-default fa fa-print pull-right" aria-hidden="true"></a>
                    </div>
                </div>
            </div>
        </form>
        
    </div>  
</div>

@endsection
