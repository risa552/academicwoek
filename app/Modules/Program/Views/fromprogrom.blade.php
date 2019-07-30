@extends('academic-layout') 
@section('title','เพิ่มข้อมูลแผนการเรียนน')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default"> 
                 <a herf="/program" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                    @if(isset($items))
                    แผนการเรียน : {{$items->program_id}}
                    @else
                    เพิ่มแผนการเรียน
                    @endif
                </div>
                @if(isset($items))
                <form action="/program/{{$items->program_id}}" class="form-ajax" method="PUT">
                    <input type="hidden" value="put" name="_mathods">
                    @csrf()
                @else
                <form class="form-ajax" action="/program" method="POST">
                @csrf()
                @endif
                <div class="panel-body">
                    <div class="form-group">
                        <label >สาขา:</label>
                        <select name="bran_id">
                            <option value="all">
                                ทั้งหมด
                            </option>
                        @foreach($items2 as $index => $row1)
                            <option value ="{{$row1->bran_id}}" {{isset($items)&& $items->bran_id==$row1->bran_id?'selected':''}}> 
                                {{$row1->bran_name}}
                            </option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label >ภาคเรียน:</label>
                        <select name="term_id">
                            <option value="all">
                                ทั้งหมด
                            </option>
                        @foreach($items3 as $index => $row2)
                            <option value ="{{$row2->term_id}}" {{isset($items)&& $items->term_id==$row2->term_id?'selected':''}}>
                                {{$row2->term_name}}
                            </option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label >วิชา:</label>
                        <select name="sub_id">
                            <option value="all">
                                ทั้งหมด
                            </option>
                        @foreach($items4 as $index => $row3)
                            <option value ="{{$row3->sub_id}}" {{isset($items)&& $items->sub_id==$row3->sub_id?'selected':''}}>
                                {{$row3->sub_name}}
                            </option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label >อาจารย์:</label>
                        <select name="teach_id">
                            <option value="all">
                                ทั้งหมด
                            </option>
                        @foreach($items5 as $index => $row4)
                            <option value ="{{$row4->teach_id}}" {{isset($items)&& $items->teach_id==$row4->teach_id?'selected':''}}>
                                {{$row4->first_name}}  {{$row4->last_name}} 
                            </option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>คาบเรียน : </label>
                        <select  name="class" class="form-control">
                            <option {{isset($items) && $items->class=='8:00-12:00'?' selected ':''}} value="8:00-12:00">8:00-12:00</option>
                            <option {{isset($items) && $items->class=='9:00-12:00'?' selected ':''}} value="9:00-12:00">9:00-12:00</option>
                            <option {{isset($items) && $items->class=='13:00-16:00'?' selected ':''}} value="13:00-16:00">13:00-16:00</option>
                            <option {{isset($items) && $items->class=='13:00-17:00'?' selected ':''}} value="13:00-17:00">13:00-17:00</option>
                            <option {{isset($items) && $items->class=='13:00-18:00'?' selected ':''}} value="13:00-18:00">13:00-18:00</option>
                            <option {{isset($items) && $items->class=='18:00-20:00'?' selected ':''}} value="18:00-20:00">18:00-20:00</option>
                        </select>
                        <!--<input type="text" name="class" class="form-control" value="{{isset($items)?$items->class:''}}"/>-->
                    </div>
                    <div class="form-group">
                        <label>ห้องเรียน : </label>
                        <input type="text" name="room" class="form-control" value="{{isset($items)?$items->room:''}}"/>
                    </div>
                    <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                </form>
        </div>
    </div>  
</div>

@endsection