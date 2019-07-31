@extends('academic-layout') 
@section('title',' ข้อมูลหลักสูตร')
@section('content')
<div class="well">
    <div class="row">
         <div class="col-md-12">
            <div class="well" style="background-color:#33d9b2;">
            <div class="media">
                <div class="media-left media-middle">
                    <img src="https://www.w3schools.com/bootstrap/img_avatar1.png" class="media-object" style="width:90px">
                </div>
                <div class="media-body">
                    <h4 class="media-heading">ข้อมูลนักศึกษา</h4>
                    <p>
                    ห้อง BIT15942N สาขา เทคโนโลยีสารสนเทศ คณะ บริหาร</p>
                </div>
            </div>
            </div>
            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">รายการลงทะเบียนนักศึกษา</button>
                <div id="demo" class="collapse in">
                <form class="form-ajax" id="program_open" action="/enrostudent" method="POST">
                    <table class="table table-bordered" >
                        <thead style="background-color:#a4b4fb">
                            <tr>
                                <th>รหัสวิชา</th>
                                <th>ชื่อวิชา</th>
                                <th>หน่วยกิต</th>
                                <th>ตารางเรียน</th>
                                <th>อาจารย์ผู้สอน</th>
                                <!--<th>ตารางสอบ</th>-->
                                <th>ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($program_open as $index =>$row)
                            <tr>
                                <td>
                                <input type="hidden" name="program_id[]" value="{{$row->program_id}}"/>
                                {{$row->sub_code}}</td>
                                <td>{{$row->sub_name}}</td>
                                <td>{{$row->credit}}</td>
                                <td>{{$row->class}} {{$row->room}}</td>
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
            @if(!$program_open->isEmpty())
            <a id="program_open_btn" href="javascript:;" class="btn btn-info pull-right">ยืนยัน</a>
            @endif
            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#row">รายวิชาที่ลงทะเบียนไปแล้ว</button>
            <div id="row" class="collapse in">
                <table class="table table-bordered">
                    <thead style="background-color:#a4b4fb">
                        <tr>
                            <th>รหัสวิชา</th>
                            <th>ชื่อวิชา</th>
                            <th>หน่วยกิต</th>
                            <th>ตารางเรียน</th>
                            <th>คารางสอบ</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($program_selected as $index =>$row)
                            <tr>
                                <td>{{$row->sub_code}}</td>
                                <td>{{$row->sub_name}}</td>
                                <td>{{$row->credit}}</td>
                                <td>{{$row->class}} {{$row->room}}</td>
                                <td>{{$row->first_name}} {{$row->last_name}}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
