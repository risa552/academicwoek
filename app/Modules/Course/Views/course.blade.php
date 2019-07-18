@extends('academic-layout') 
@section('title','ลงทะเบียน')
@section('content')
        <div class="well">
            <H1>ข้อมูลนักศึกษา</H1>
                <div style="display: table; width:100%; margin-bottom:15px;">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                            <th scope="col">รหัสลงทะเบียน</th>
                            <th scope="col">รหัสวิชาที่เปิดสอน</th>
                            <th scope="col">รหัสนักศึกษา</th>
                            <th scope="col">เกรด</th>
                            <th scope="col">วันเดือนปีที่ลงทะเบียน</th>
                            <th scope="col">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row">1</th>
                            <td>01</td>
                            <td>159333241057</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            </tr>
                            <tr>
                            <th scope="row">2</th>
                            <td>02</td>
                            <td>159333241059</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            </tr>
                            <tr>
                            <th scope="row">3</th>
                            <td>03</td>
                            <td>159333241060</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            </tr>
                        
                            <!--<i class="fa fa-plus-circle" aria-hidden="true"></i> --> 
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-info pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> ยืนยัน</button>
                </div>   
            <div>
                <table class="table">
                <thead class="thead-light">
                <tr>
                <th scope="col">รหัสลงทะเบียน</th>
                            <th scope="col">รหัสวิชาที่เปิดสอน</th>
                            <th scope="col">รหัสนักศึกษา</th>
                            <th scope="col">เกรด</th>
                            <th scope="col">วันเดือนปีที่ลงทะเบียน</th>
                            <th scope="col">สถานะ</th>
                        </tr>
                </thead>
                </table>
            </div>
        </div>
    
@endsection