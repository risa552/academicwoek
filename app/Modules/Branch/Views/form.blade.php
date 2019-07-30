@extends('academic-layout') 
@section('title','เพิ่มสาขาวิชา')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default"> 
                 <a herf="/branch" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                    @if(isset($items))
                    สาขา : {{$items->bran_name}}
                    @else
                    เพิ่มสาขา
                    @endif
                </div>
                @if(isset($items))
                <form action="/branch/{{$items->bran_id}}" class="form-ajax" method="PUT">
                    <input type="hidden" value="put" name="_mathods">
                    @csrf()
                @else
                <form class="form-ajax" action="/branch" method="POST">
                @csrf()
                @endif
                    <div class="panel-body">
                        <label >ชื่อสาขา:</label>
                        <input type="text" name="bran_name" class="form-control" value="{{isset($branch)?$items->bran_name:''}}"/>
                        </div>
                            <div class="form-group">
                                <label >หลักสูตร:</label>
                                <select style="width:150px;" name="cou_id">
                                    <option value="all">
                                        ทั้งหมด
                                    </option>
                                @foreach($items2 as $index => $row1)
                                    <option value ="{{$row1->cou_id}}" {{isset($items)&& $items->cou_id==$row1->cou_id?'selected':''}}>
                                        {{$row1->cou_name}}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label >แผนการเรียน:</label>
                                <select style="width:150px;" name="program_id">
                                    <option value="all">
                                        ทั้งหมด
                                    </option>
                                @foreach($items3 as $index => $row2)
                                    <option value ="{{$row2->program_id}}" {{isset($items)&& $items->program_id==$row2->program_id?'selected':''}}>
                                        {{$row2->program_id}}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                    <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>

                    </div>
                    <!--<button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button> -->
                </form>
        </div>
    </div>  
</div>

@endsection