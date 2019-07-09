@extends('academic-layout') 
@section('title','การส่งข้อสอบ')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาวิชา</div>
                <div class="panel-body">
                    <form action="/action_page.php">
                        <div class="form-group">
                            <label for="email">ชื่ออาจารย์</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="pwd">ชื่อวิชา</label>
                            <input type="password" class="form-control" id="pwd">
                        </div>
                        <button type="submit" class="btn btn-default">ยืนยัน</button>
                    </form>
                </div>
            </div>
            <button type="submit" class="btn btn-info"><a href="#">ส่งข้อสอบ</a></button>
        </div> 
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">รายการการส่งข้อสอบ</div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>รหัสการส่งข้อสอบ</th>
                                <th>รหัสวืชา</th>
                                <th>ชื่อวิชา</th>
                                <th>ส่งวันที่</th>
                                <th style="width:110px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                        @for($i=0;$i<25;$i++)
                            <tr>
                                <td>01</td>
                                <td>306-03-03</td>
                                <td>ดาต้าเบด</td>
                                <td>25-1-62</td>
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