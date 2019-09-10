@extends('academic-layout') 
@section('title',' ข้อมูลลงทะเบียน')
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
                <!-- <li class="breadcrumb__group">
                <a href="/educate" class="breadcrumb__point r-link">ข้อมูลภาระการสอน</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li> -->
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">ลงทะเบียน</span>
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
                            <b>รหัสนักศึกษา:</b> {{$hit->number}}<br>
                            <b>กลุ่มเรียน:</b> {{$hit->group_name}}<br>
                            <b>ระดับ:</b> {{$hit->degree_name}}<br>
                            <b>สาขาวิชา:</b> {{$hit->bran_name}}<br>
                            <b>หลักสูตร:</b> {{$hit->cou_name}}<br>
                            </td>
                            <!--<tr>
                                <td style="width:150px;"><b>รหัสนักศึกษา</b></td>
                                <td>{{$hit->number}}</td>
                            </tr>
                            <tr>
                                <td style="width:150px;"><b>ชื่อนักศึกษา</b></td>
                                <td>{{$hit->first_name}} {{$hit->last_name}}</td>
                            </tr>
                            <tr>
                                <td style="width:150px;"><b>ข้อมูลระดับ</b></td>
                                <td>{{$hit->degree_name}}</td>
                            </tr>
                            <tr>
                                <td style="width:150px;"><b>ข้อมูลสาขา</b></td>
                                <td>{{$hit->bran_name}}</td>
                            </tr>
                            <tr>
                                <td style="width:150px;"><b>ข้อมูลหลักสูตร</b></td>
                                <td>{{$hit->cou_name}}</td>
                            </tr>-->
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
            <div class="col-md-12">
                <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">รายการลงทะเบียนนักศึกษา</button>
                    <div id="demo" class="collapse in">
                    <form class="form-ajax" id="program_open" action="/enrostudent" method="POST">
                        <table class="table table-striped" >
                            <thead style="background-color:#a4b4fb">
                                <tr>
                                    <th>รหัสวิชา</th>
                                    <th>ชื่อวิชา</th>
                                    <th>หน่วยกิต</th>
                                    <th>อาจารย์ผู้สอน</th>
                                    <!--<th>ตารางสอบ</th>-->
                                    <th>ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($program_open as $index =>$row)
                                <tr>
                                    <td>
                                    <input type="hidden" name="subject_id[]" value="{{$row->sub_id}}"/>
                                    {{$row->sub_code}}</td>
                                    <td>{{$row->sub_name}}</td>
                                    <td>{{$row->credit}}</td>
                                    <td>{{$row->first_name}} {{$row->last_name}}</td>
                                    <td>
                                        <a class="remove-row" href="javascript:;"><i class="fa fa-times btn btn-danger" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </form>
                    </div>
                @if(!empty($program_open))
                <a id="program_open_btn" href="javascript:;" class="btn btn-info pull-right">ยืนยัน</a>
                @endif
                <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#row">รายวิชาที่ลงทะเบียนไปแล้ว</button>
                <div id="row" class="collapse in">
                    <table class="table table-striped">
                        <thead style="background-color:#a4b4fb">
                            <tr>
                                <th>รหัสวิชา</th>
                                <th>ชื่อวิชา</th>
                                <th>หน่วยกิต</th>
                                <th>อาจารย์ผู้สอน</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($program_selected as $index =>$row1)
                                <tr>
                                    <td>{{$row1->sub_code}}</td>
                                    <td>{{$row1->sub_name}}</td>
                                    <td>{{$row1->credit}}</td>
                                    <td>{{$row1->first_name}} {{$row1->last_name}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function(){
    $('.remove-row').on('click',function(e){
        e.preventDefault();
        if(confirm('ท่านต้องการจะลบรายการนี้ใช่หรือไม่'))
        {
            $(this).parent().parent().remove();
        }
    });
    $('#program_open_btn').on('click',function(e){
        e.preventDefault();
        $('#program_open').submit();
    })
})
</script>
@endpush
