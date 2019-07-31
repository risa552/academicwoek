@extends('academic-layout') 
@section('title',' ข้อมูลหลักสูตร')
@section('content')
<div class="well">
    <div class="row">
         <div class="col-md-12">
            <div class="well" style="background-color:#33d9b2;">
            <div class="media">
                <div class="media-left media-middle">
                    <img src="https://www.w3schools.com/bootstrap/img_avatar1.png" class="media-object" style="width:90px">
                </div>
                <div class="media-body">
                    <h4 class="media-heading">ข้อมูลนักศึกษา</h4>
                    <p>
                    ห้อง BIT15942N สาขา เทคโนโลยีสารสนเทศ คณะ บริหาร</p>
                </div>
            </div>
            </div>
            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">รายการลงทะเบียนนักศึกษา</button>
                <div id="demo" class="collapse in">
                    <table class="table table-bordered" >
                        <thead style="background-color:#a4b4fb">
                            <tr>
                                <th>รหัสวิชา</th>
                                <th>ชื่อวิชา</th>
                                <th>หน่วยกิต</th>
                                <th>sec.</th>
                                <th>ตารางเรียน</th>
                                <th>อาจารย์ผู้สอน</th>
                                <th>ตารางสอบ</th>
                                <th>ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>309-11-04[54]</td>
                                <td>Computer Mathematics</td>
                                <td>3 (3-0-6)</td>
                                <td>1</td>
                                <td>จ(8:00-12:00) 201003</td>
                                <td>อ. จงกลนี ลิ้มประภัสสร</td>
                                <td></td>
                                <td><i class="fa fa-times btn btn-danger" aria-hidden="true"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <a class="btn btn-info pull-right">ยืนยัน</a>
            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#row">รายวิชาที่ลงทะเบียนไปแล้ว</button>
            <div id="row" class="collapse in">
                <table class="table table-bordered">
                    <thead style="background-color:#a4b4fb">
                        <tr>
                            <th>รหัสวิชา</th>
                            <th>ชื่อวิชา</th>
                            <th>หน่วยกิต</th>
                            <th>sec.</th>
                            <th>ถอน</th>
                            <th>ตารางเรียน</th>
                            <th>คารางสอบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>306-11-06 [54]</td>
                            <td>Computer Technology and Operating System</td>
                            <td>3 (2-2-5)</td>
                            <td>1</td>
                            <td><i class="fa fa-times btn btn-danger" aria-hidden="true"></i></td>
                            <td>อ.(8:00-12:00) 201003</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
