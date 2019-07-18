@extends('academic-layout') 
@section('title',' ข้อมูลนักศึกษา')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหานักศึกษา</div>
                <div class="panel-body">
                    <form action="/action_page.php">
                        <div class="form-group">
                            <label for="email">รหัสนักศึกษา</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="email">ชื่อนักศึกษา</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <button type="submit" class="btn btn-default">ยืนยัน</button>
                    </form>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">นักศึกษา</a></button> -->
        </div> 
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    รายการชื่ออาจารย์
                    <a href="/student/fromstu" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มนักศึกษา</a>
                </div>
                <div class="panel-body">  
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>รหัสนักศึกษา</th>
                                <th>ชื่อ</th>
                                <th>นามสกุล</th>
                                <th>เพศ</th>
                                <th>เบอร์</th>
                                <th>ที่อยู่</th>
                                <th>E-mail</th>
                                <th>รหัสกลุ่มเรียน</th>
                                <th>รหัสลงทะเบียน</th>
                                <th>รหัสสิทธิ์</th>
                                <th style="width:110px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>159333241057</td>
                                <td>เยาวเรศ</td>
                                <td>วงศ์สามารถ</td>
                                <td>หญิง</td>
                                <td>08XXXXXXXX</td>
                                <td>ท่าอิฐ</td>
                                <td>fan@gmail.com</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info"><a class="fa fa-pencil-square" aria-hidden="true" href="/student/editstu"></a></button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#flipFlop"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        <div class="modal fade" id="flipFlop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h4 class="modal-title" id="modalLabel">ยืนยันการลบ</h4>
                                                        </div>
                                                        <div class="modal-body" style="color:#000;">
                                                        <p>ต้องการจะลบใช่หรือไม่ </p>
                                                        </div>
                                                        <div class="modal-footer" action="/action_page.php">
                                                        <button type="submit" class="btn btn-info">Submit</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>    
                                                </div>
                                            </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>159333241060</td>
                                <td>ริสา</td>
                                <td>เบ็ญมูซา</td>
                                <td>หญิง</td>
                                <td>08XXXXXXXX</td>
                                <td>ไทรน้อย</td>
                                <td>sa@gmail.com</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info"><a class="fa fa-pencil-square" aria-hidden="true" href="/student/editstu"></a></button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#flipFlop"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        <div class="modal fade" id="flipFlop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h4 class="modal-title" id="modalLabel">ยืนยันการลบ</h4>
                                                        </div>
                                                        <div class="modal-body" style="color:#000;">
                                                        <p>ต้องการจะลบใช่หรือไม่ </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <button type="submit" class="btn btn-info">Submit</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
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
