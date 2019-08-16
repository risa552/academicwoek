@extends('academic-layout') 
@section('title','เพิ่มข้อมูลภาระการสอน')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default"> 
                 <a herf="/educate" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                    ภาระการสอนวิชา : {{$item->sub_name}}
                </div>
                @if(isset($teacher))
                <form action="/educate/{{$teacher->educate_id}}" class="form-ajax" method="PUT">
                    <input type="hidden" value="put" name="_mathods">
                    @csrf()
                @else
                <form class="form-ajax" action="/educate" method="POST">
                @csrf()
                @endif
                <input type="hidden" value="{{$item->sub_id}}" name="sub_id">
                <input type="hidden" value="{{$item->term_id}}" name="term_id">

                <div class="panel-body">
                    <div class="form-group">
                        <label >รหัสวิชา : {{$item->sub_code}}</label>
                    </div>
                    <div class="form-group">
                        <label >ชื่อวิชา : {{$item->sub_name}}</label>
                    </div>
                    <div class="form-group">
                        <label >ภาคเรียน : {{$item->term_name}}/{{$item->year}}</label>
                    </div>
                    <div class="form-group">
                        <label >อาจารย์:</label>
                        <select name="teach_id">
                            <option value="all">
                                ทั้งหมด
                            </option>
                        @foreach($teachers as $index => $row1)
                            <option value ="{{$row1->teach_id}}" {{isset($teacher)&& $teacher->teach_id==$row1->teach_id?'selected':''}}> 
                                {{$row1->first_name}} {{$row1->last_name}}
                            </option>
                        @endforeach
                        </select>
                    </div>
                   
                    <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                </form>
        </div>
    </div>  
</div>

@endsection