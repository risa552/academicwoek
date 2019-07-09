@extends('academic-layout') 
@section('title','เข้าสู่ระบบ')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <form action="/action_page.php">
                        <div class="form-group">
                            <label for="email">รหัสนักศึกษา</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="pwd">ชื่อนักศึกษา</label>
                            <input type="password" class="form-control" id="pwd">
                        </div>
                        
                        <button type="submit" class="btn btn-default">ค้นหา</button>
                    </form>
                </div>
            </div>
            <button type="submit" class="btn btn-info"><a href="/product/productfrom">เพิ่มรายวิชา</a></button>
        </div> 
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">ข้อมูลนักศึกษา</div>
                      <b>ชื่อ-สกุล</b> : 159333241057 เยาวเรศ วงศ์สามารถ<br>
                      <b>ข้อมูลคณะ (หน่วยงานหลัก)</b> : 03 บริหารธุรกิจและเทคโนโลยีสารสนเทศ<br>
                      <b>ข้อมูลหลักสูตร</b> : 305 เทคโนโลยีสารสนเทศธุรกิจ 2554 หลักสูตร 4ปี 134หน่วยกิต <br>
                      <b>ข้อมูลระดับการศึกษา</b> :ปริญญาตรี ปกติ<br></div>
                <div class="ui-state-highlight ui-corner-all" style="margin-top: 5px; padding: 0 .7em;height:20px;">
             </div>
                  <center> <button class="btn การศึกษาทั่วไป">การศึกษาทั่วไป</button>
                  <button class="btn วิชาเฉพาะด้าน">วิชาเฉพาะด้าน</button>
                  <button class="btn วิชาเลือกเสรี">วิชาเลือกเสรี</button>
             <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                             <tr>
                                <th>รหัสวิชา</th>
                                <th>ชื่อวิชาภาษาไทย</th>
                                <th>ชื่อวิชาภาษาอังกฤษ</th>
                                <th>จำนวนหน่วยกิต</th>
                                <th>หน่วยกิต</th>
                                <th style="width:110px">แก้ไข</th>
                            </tr>
                            </thead>
                          <tbody>
                        @for($i=0;$i<25;$i++)
                            </tr>
                            <td>01</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-primary">แก้ไข</button>
                                        <button type="button" class="btn btn-sm btn-primary">ลบ</button>
                                    </div>
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                        </table>
                    <ul class="pagination">
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>  
    @endsection