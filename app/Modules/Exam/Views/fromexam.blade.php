@extends('academic-layout') 
@section('title','เพิ่มข้อมูลส่งข้อสอบ')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">  
                <div class="panel-heading">เพิ่มข้อมูลข้อสอบ</div>
                @if(isset($exam))
                    ข้อสอบ {{$exam->sub_name}}
                    @else
                @endif
                @if(isset($exam))
                    <form action="/exam/{{$exam->sub_id}}" class="form-ajax" method="PUT">
                        <input type="hidden" value="put" name="_mathods">
                        @csrf()
                    </form>
                    @else
                    <form class="form-ajax" action="/exam" method="POST">
                        @csrf()
                @endif
                    <div class="panel-body">
                            <div class="form-group">
                                <label for="email">ชื่อข้อสอบ:</label>
                                <input type="text" name="exame_name" class="form-control" value="{{isset($exam)?$exam->exam_name:''}}"/>
                            </div>
                            <div class="form-group">
                                <label for="pwd">ว.ด.ป.ที่ส่งข้อสอบ:</label>
                                <input type="text" name="dete" class="form-control" value="{{isset($exam)?$exam->date:''}}"/>
                            </div>
                            <div class="form-group">
                                <label for="pwd">รหัสวิชา:</label>
                                <input type="text" name="sub_id" class="form-control" value="{{isset($exam)?$exam->sub_id:''}}"/>
                            </div>
                            <div class="form-group" >
                                <label for="exampleFormControlFile1">ไฟล์ข้อสอบ:</label>
                                <input type="file" class="form-control-file" >
                            </div>
                        <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                    </div>
                    </form>
            </div>
        </div>
    </div>  
</div>

@endsection