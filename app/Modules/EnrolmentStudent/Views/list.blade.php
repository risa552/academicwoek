@extends('academic-layout') 
@section('title',' ข้อมูลลงทะเบียน')
@section('content')
<div class="well">
    <div class="row">
         <div class="col-md-8">
            <div style="background-color:#33d9b2;">
               <table class="table table-bordered" >
                @foreach($history as $index => $hit)
                    <tr>
                        <td>
                        <b>ชื่อนักศึกษา:</b> {{$hit->first_name}} {{$hit->last_name}}<br>
                        <b>รหัสนักศึกษา:</b> {{$hit->number}}
                        <b>กลุ่มเรียน:</b> {{$hit->group_name}}<br>
                        <b>ระดับ:</b> {{$hit->degree_name}}
                        <b>สาขาวิชา:</b> {{$hit->bran_name}}<br>
                        <b>หลักสูตร:</b> {{$hit->cou_name}}
                        </td>
                    </tr>
                @endforeach
                </table>
            </div>
        </div>
        <div class="col-md-12">
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
                            <th>อาจารย์ผู้สอน</th>
                            <th>ตารางสอบ</th>
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
