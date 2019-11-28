@extends('academic-layout') 
@section('title','ข้อมูลภาระการสอน')
@section('content')
<div class="container">
    <div class="col-md-10">
        <div class="page__section">
            <nav class="breadcrumb breadcrumb_type5" aria-label="Breadcrumb">
            <ol class="breadcrumb__list r-list">
                <li class="breadcrumb__group">
                <a href="/" class="breadcrumb__point r-link"><i class="fa fa-home" aria-hidden="true"></i></a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                <!-- </li>
                <li class="breadcrumb__group">
                <a href="/professor" class="breadcrumb__point r-link">ข้อมูลอาจารย์</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li> -->
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">ข้อมูลภาระการสอน</span>
                </li>
            </ol>
            </nav>
        </div>
    <div>
</div>
<!-- <div class="container"> -->
    <!-- <div class="row">
        <div class="col-md-12"> -->
        <div class="panel panel-info">
            <div class="panel-heading">
            รายงานภาระการสอน
            <a  class="btn btn-default fa fa-print pull-right" href="/print-educate" aria-hidden="true"></a>
            </div>
                <div class="panel-body">
                    <p style="text-align:center;">มหาวิทยาลัยราชมงคลสุวรรณภูมิ ศูนย์นนทบุรี</p>
                    <p style="text-align:center;">บัญชีภาระการสอนส่วนบุคคลสาขาเทคโนโลยีสารสนเทศและคอมพิวเตอร์ธุรกิจ </p>
                    <p style="text-align:center;">ประจำภาคการศึกษาที่ {{$terms->term_name}} ปีการศึกษา {{$terms->term_year}} </p>
                    <p style="text-align:center;">(จำนวนคาบต่อสัปดาห์ ท = ทฤษฏี, ป = ปฏิบัติ)</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th rowspan=4 style="text-align:center;">ลำดับ</th>
                                <th rowspan=4 style="text-align:center;padding-right:100px;">อาจารย์</th>
                                <th colspan=2 rowspan=2 style="text-align:center;">รายวิชา</th>
                                <th colspan=2 rowspan=2 style="text-align:center;">ห้องเรียน</th>
                                <th colspan=10  style="text-align:center;">จำนวนคาบ</th>
                                <th rowspan=4 >ลายเซ็นรับทราบ</th>
                                <th rowspan=4>วดป.ส่งข้อสอบกลางภาค</th>
                                <th rowspan=4>วดป.ส่งข้อสอบปลายภาค</th>
                            </tr>
                            <tr>
                                <th colspan=4 style="text-align:center;">รอบเช้า</th>
                                <th colspan=3 style="text-align:center;">สมทบ</th>
                                <th colspan=3 style="text-align:center;">รวมทั้งสิ้น</th>
                            </tr>
                            <tr>
                                <th rowspan=2 style="height:25px; width:100px;">รหัสวิชา</th>
                                <th rowspan=2>วิชา</th>
                                <th rowspan=2>ปวส.</th>
                                <th rowspan=2>ป.ตรี</th>
                                <th rowspan=2>ท</th>
                                <th rowspan=2>ป</th>
                                <th colspan=2 style="text-align:center;">รวม</th>
                                <th rowspan=2>ท</th>
                                <th rowspan=2>ป</th>
                                <th style="text-align:center;">รวม</th>
                                <th rowspan=2>รอบเช้า</th>
                                <th rowspan=2>สมทบ</th>
                                <th rowspan=2 style="text-align:center;">รวมรอบเช้า/สมทบ</th>
                            </tr>
                            <tr>
                                <th>ปวส.</th>
                                <th>ป.ตรี</th>
                                <th>ป.ตรี</th>
                                <!-- <th>ปวส.</th>
                                <th>ป.ตรี</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $index => $row)
                         <?php
                         $C=[];
                         for($i=1;$i<=10;$i++){
                            $C[$i]=0;
                         }                
                         ?>
                            @foreach($row['items'] as $i => $item)
                            <tr>
                                <td>{{$i==0?$index+1:''}}</td>
                                <td>{{$item['name']}} {{$item['surname']}}</td>
                                <td style="white-space: nowrap; overflow:hidden; text-overflow:ellipsis">{{$item['sub_code']}}</td>
                                <td style="white-space: nowrap; overflow:hidden; text-overflow:ellipsis">{{$item['sub_name']}}<br> {{$item['sub_name_eng']}}</td>
                                <td>{{$item['degree_1']}}</td>
                                <td>{{$item['degree_2']}}</td>
                                @for($i=1;$i<=10;$i++)
                                <?php $C[$i]+=is_numeric($item['C'.$i])?$item['C'.$i]:0; ?>
                                <td style="text-align:center;">{{$item['C'.$i]}}</td>
                                @endfor
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td style="white-space: nowrap; overflow:hidden; text-overflow:ellipsis"></td>
                                <td style="white-space: nowrap; overflow:hidden; text-overflow:ellipsis">รวม</td>
                                <td></td>
                                <td></td>
                                @for($i=1;$i<=10;$i++)
                                <td style="text-align:center;">{{$C[$i]}}</td>
                                @endfor
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        <!-- </div> -->
    <!-- </div>   -->
<!-- </div> -->
@endsection