@extends('academic-layout') 
@section('title','ข้อมูลวิชาที่เปิดสอน')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาวิชาที่เปิดสอน</div>
                <div class="panel-body">
                    <form action="/action_page.php">
                        <div class="form-group">
                            <label for="email">คาบเรียน</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="email">รหัสภาคเรียน</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <button type="submit" class="btn btn-default">ยืนยัน</button>
                    </form>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">ข้อมูลวิชาที่เปิดสอน</a></button> -->
        </div> 
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    รายการข้อมูลวิชาที่เปิดสอน
                    <a href="/teach/fromte" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มข้อมูลวิชาที่เปิดสอน</a>
                </div>
                <div class="panel-body">  
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>คาบเรียน</th>
                                <th>วัน/เดือน/ปี ที่สร้าง</th>
                                <th>รหัสภาคเรียน</th>
                                <th style="width:110px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>เช้า</td>
                                <td></td>
                                <td>2562</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info"><a class="fa fa-pencil-square" aria-hidden="true" href="/teach/editte"></a></button>
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
                            <td>บ่าย</td>
                                <td></td>
                                <td>2562</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info"><a class="fa fa-pencil-square" aria-hidden="true" href="/teach/editte"></a></button>
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
