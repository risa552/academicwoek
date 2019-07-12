@extends('academic-layout') 
@section('title','ข้อมูลแผนการเรียน')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาแผนการเรียน</div>
                <div class="panel-body">
                    <form action="/action_page.php">
                        <div class="form-group">
                            <label for="email">รหัสแผนการเรียน</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="email">ชื่อแผนการเรียน</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <button type="submit" class="btn btn-default">ยืนยัน</button>
                    </form>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">ข้อมูลแผนการเรียน</a></button> -->
        </div> 
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    รายการข้อมูลแผนการเรียน
                    <a href="/program/frompro" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มข้อมูลแผนการเรียน</a>
                </div>
                <div class="panel-body">  
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>รหัสแผนการเรียน</th>
                                <th>ชื่อแผนการเรียน</th>
                                <th>รหัสวิชา</th>
                                <th>รหัสภาคเรียน</th>
                                <th style="width:110px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info"><a class="fa fa-pencil-square" aria-hidden="true" href="/program/editpro"></a></button>
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
                            <td>2</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info"><a class="fa fa-pencil-square" aria-hidden="true" href="/program/editpro"></a></button>
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
