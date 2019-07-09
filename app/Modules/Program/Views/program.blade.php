@extends('academic-layout') 
@section('title','เข้าสู่ระบบ')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                
                        <div class="form-group">
                            <label for="email">ภาคเรียน</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="email">รหัสวิชา</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="email">ชื่อวิชา</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="email">ปีการศึกษา</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        
                        <button type="submit" class="btn btn-default">ค้นหา</button>
                    </form>
                </div>
            </div>

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
                 
             <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                             <tr>
                                <th>ภาคเรียน</th>
                                <th>รหัสวิชา</th>
                                <th>ชื่อวิชา</th>
                                <th>ปีการศึกษา</th>
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