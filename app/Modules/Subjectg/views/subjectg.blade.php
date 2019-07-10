@extends('academic-layout') 
@section('title','กลุ่มวิชา')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาวิชา</div>
                <div class="panel-body">
                    <form action="/action_page.php">
                        <div class="form-group">
                            <label for="email">รห้สกลุ่มวิชา</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <button type="submit" class="btn btn-default">ยืนยัน</button>
                    </form>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-info"><a href="#">เพิ่มกลุ่มวิชา</a></button> -->
        </div>  
<div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                กลุ่มวิชาการศึกษา
                 <a href="/subjectg/table" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มกลุ่มวิชา</a>
            </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>รหัสกลุ่มวิชา</th>
                                <th>ชื่อกลุ่มวิชา</th>
                               
                                <th style="width:110px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            
                                <td>1</td>
                                <td>การศึกษาทั่วไป</td>
                                <td>
                            
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info"><i class="fa fa-pencil-square" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                 <td>2</td>
                                 <td>การศึกษาเฉพาะด้าน</td>
                                 <td>
                            
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info"><i class="fa fa-pencil-square" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                 <td>3</td>
                                <td>การศึกษาเลือกเสรี</td>
                                <td>
                            
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info"><i class="fa fa-pencil-square" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </div>
                                 </td>
                            </tr>
                            
                            
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
      
 

@endsection