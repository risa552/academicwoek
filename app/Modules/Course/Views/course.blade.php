@extends('academic-layout') 
@section('title','ลงทะเบียน')
@section('content')
        <div class="well">
            <H1>ข้อมูลนักศึกษา</H1>
                <div style="display: table; width:100%; margin-bottom:15px;">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                            <th scope="col">รหัสวิชา</th>
                            <th scope="col">ชื่อวิชา</th>
                            <th scope="col">หน่อยกิต</th>
                            <th scope="col">กลุ่มเรียน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            </tr>
                            <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                            </tr>
                            <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
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
                        <th scope="col">รหัสวิชา</th>
                        <th scope="col">ชื่อวิชา</th>
                        <th scope="col">หน่วยกิต</th>
                        <th scope="col">กลุ่มเรียน</th>
                        </tr>
                </thead>
                </table>
            </div>
        </div>
    
@endsection