@extends('academic-layout') 
@section('title',' ข้อมูลการศึกษา')
@section('content')
<div class="container">
        <div class="col-md-10">
            <div class="page__section">
                <nav class="breadcrumb breadcrumb_type5" aria-label="Breadcrumb">
                <ol class="breadcrumb__list r-list">
                    <li class="breadcrumb__group">
                    <a href="/" class="breadcrumb__point r-link"><i class="fa fa-home" aria-hidden="true"></i></a>
                    <span class="breadcrumb__divider" aria-hidden="true">›</span>
                    </li>
                    <li class="breadcrumb__group">
                    <a href="/educate" class="breadcrumb__point r-link">ข้อมูลภาระการสอน</a>
                    <span class="breadcrumb__divider" aria-hidden="true">›</span>
                    </li> 
                    <li class="breadcrumb__group">
                    <span class="breadcrumb__point" aria-current="page">ข้อมูลการศึกษา</span>
                    </li>
                </ol>
                </nav>
            </div>
        <div>
</div>
<div class="container">
    <div class="well">
        <div class="row">
            <div class="col-md-5">
                <div>
                <table class="table table-bordered" style="margin-left:400px; background-color:#33d9b2;" >
                    @foreach($history as $index => $hit)
                        <tr>
                            <td>
                            <b>ชื่อนักศึกษา:</b> {{$hit->first_name}} {{$hit->last_name}}<br>
                            <b>รหัสนักศึกษา:</b> {{$hit->number}} <br>
                            <b>กลุ่มเรียน:</b> {{$hit->group_name}}<br>
                            <b>ระดับ:</b> {{$hit->degree_name}}<br>
                            <b>สาขาวิชา:</b> {{$hit->bran_name}}<br>
                            <b>หลักสูตร:</b> {{$hit->cou_name}}<br>
                            </td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
            <div class="container" >
                <div class="col-md-11">
                    <div class="panel panel-default">
                        <!-- <div class="panel-heading">
                        
                        </div> -->
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th rowspan="3" style="text-align:center;">ภาคเรียน</th>
                                        <th colspan="5" style="text-align:center;">ต่อเทอม</th>
                                        <th colspan="5" style="text-align:center;">สะสม</th>
                                    </tr>
                                    <tr>
                                            <th colspan="4" style="text-align:center;">หน่วยกิต</th>
                                            <th rowspan="2" style="text-align:center;">เกรดเฉลี่ย</th>
                                            <th colspan="4" style="text-align:center;">หน่วยกิต</th>
                                            <th rowspan="2" style="text-align:center;">เกรดเฉลี่ย</th>
                                    </tr>
                                    <tr>
                                            <th>ลง</th>
                                            <th>ได้</th>
                                            <th>คำนวณ</th>
                                            <th>คะแนน</th>
                                            <th>ลง</th>
                                            <th>ได้</th>
                                            <th>คำนวณ</th>
                                            <th>คะแนน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th style="text-align:center;">รหัสวิชา</th>
                                                    <th style="text-align:center;">ชื่อวิชา</th>
                                                    <th style="text-align:center;">หน่วยกิต</th>
                                                    <th style="text-align:center;">เกรด</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($grades as $index => $grade)
                                                <tr>
                                                    <td>{{$index+1}}</td>
                                                    <td>{{$grade->sub_code}}</td>
                                                    <td>{{$grade->sub_name}}</td>
                                                    <td>{{$grade->credit}}({{$grade->theory}}-{{$grade->practice}})</td>
                                                    <td>{{$grade->grade}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection