@extends('academic-layout') 
@section('title','เพิ่มข้อมูลวิชา')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default"> 
                 <a herf="/subject" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                    @if(isset($items))
                    วิชา : {{$items->sub_name}}
                    @else
                    เพิ่มข้อมูลวิชา
                    @endif
                </div>
                @if(isset($items))
                <form action="/subject/{{$items->sub_id}}" class="form-ajax" method="PUT">
                    <input type="hidden" value="put" name="_mathods">
                    @csrf()
                @else
                <form class="form-ajax" action="/subject" method="POST">
                @csrf()
                @endif
                <div class="panel-body">
                        <div class="form-group">
                            <label>ชื่อวิชา:</label>
                            <input type="text" name="sub_name" class="form-control" value="{{isset($items)?$items->sub_name:''}}"/>
                        </div>
                        <div class="form-group">
                            <label>หน่วยกิต:</label>
                            <input type="text" name="credit" class="form-control" value="{{isset($items)?$items->credit:''}}"/>
                        </div>
                        <div class="form-group">
                            <label>ชั่วโมงทฎษฎี:</label>
                            <input type="text" name="theory" class="form-control" value="{{isset($items)?$items->theory:''}}"/>
                        </div>
                        <div class="form-group">
                            <label>ชั่วโมงปฎิบัติ:</label>
                            <input type="text" name="practice" class="form-control" value="{{isset($items)?$items->practice:''}}"/>
                        </div>
                        <div class="form-group">
                                <label >กลุ่มเรียน:</label>
                                <select name="subgroup_id">
                                    <option value="all">
                                        ทั้งหมด
                                    </option>
                                @foreach($items2 as $index => $row1)
                                    <option value ="{{$row1->subgroup_id}}" {{Input::get('subgroup_id')==$row1->subgroup_id?'stlected':''}}>
                                        {{$row1->subgroup_id}}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label >แผนการเรียน:</label>
                                <select name="program_id">
                                    <option value="all">
                                        ทั้งหมด
                                    </option>
                                @foreach($items3 as $index => $row2)
                                    <option value ="{{$row2->program_id}}" {{Input::get('program_id')==$row2->program_id?'stlected':''}}>
                                        {{$row2->program_name}}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                    <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                </div>                
                </form>
        </div>
    </div>  
</div>

@endsection