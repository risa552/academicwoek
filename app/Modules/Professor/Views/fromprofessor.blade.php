@extends('academic-layout') 
@section('title','เพิ่มข้อมูลอาจารย์')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default"> 
                 <a herf="/professor" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                    @if(isset($professor))
                    อาจารย์ : {{$professor->first_name}}
                    @else
                    เพิ่มอาจารย์
                    @endif
                </div>
                @if(isset($professor))
                <form action="/professor/{{$professor->id}}" class="form-ajax" method="PUT">
                    <input type="hidden" value="put" name="_mathods">
                    @csrf()
                @else
                <form class="form-ajax" action="/professor" method="POST">
                @csrf()
                @endif
                    <div class="panel-body">
                        <th>ชื่อ : </th>
                        <input type="text" name="first_name" class="form-control" value="{{isset($profressor)?$profressor->first_name:''}}"/>
                        <th>นามสกุล:</th>
                        <input type="text" name="last_name" class="form-control" value="{{isset($profressor)?$profressor->last_name:''}}"/> 
                        <th>เบอร์:</th>
                        <input type="text" name="tel" class="form-control" value="{{isset($profressor)?$profressor->Tel:''}}"/>  
                        <th>เพศ:</th>
                        <input type="text" name="sex" class="form-control" value="{{isset($profressor)?$profressor->sex:''}}"/> 
                        <th>ที่อยู่:</th>
                        <input type="text" name="add" class="form-control" value="{{isset($profressor)?$profressor->Add:''}}"/>
                        <th>email:</th>
                        <input type="text" name="email" class="form-control" value="{{isset($profressor)?$profressor->email:''}}"/> 
                       <!-- <th>รหัสการสอน:</th>
                        <input type="text" name="gender" class="form-control" value="{{isset($profressor)?$profressor->gender:''}}"/> -->
                        <th>รหัสสิทธิ์:</th>
                        <input type="text" name="pre_id" class="form-control" value="{{isset($profressor)?$profressor->pre_id:''}}"/> 
                    </div>
                    <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                </form>
        </div>
    </div>  
</div>

@endsection