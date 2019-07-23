@extends('academic-layout') 
@section('title','เพิ่มข้อมูลระดับ')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default"> 
                 <a herf="/degree" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                    @if(isset($degree))
                    ระดับ : {{$degree->degree_name}}
                    @else
                    เพิ่มข้อมูลระดับ
                    @endif
                </div>
                @if(isset($degree))
                <form action="/degree/{{$degree->degree_id}}" class="form-ajax" method="PUT">
                    <input type="hidden" value="put" name="_mathods">
                    @csrf()
                @else
                <form class="form-ajax" action="/degree" method="POST">
                @csrf()
                @endif
                    <div class="panel-body">
                        <th>ชื่อระดับ : </th>
                        <input type="text" name="degree_name" class="form-control" value="{{isset($degree)?$degree->degree_name:''}}"/>
                    </div>
                    <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                </form>
        </div>
    </div>  
</div>

@endsection