@extends('academic-layout') 
@section('title','เพิ่มสาขาวิชา')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default"> 
                 <a herf="/branch" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                    @if(isset($branch))
                    สาขา : {{$branch->bran_name}}
                    @else
                    เพิ่มสาขา
                    @endif
                </div>
                @if(isset($branch))
                <form action="/branch/{{$branch->bran_id}}" class="form-ajax" method="PUT">
                    <input type="hidden" value="put" name="_mathods">
                    @csrf()
                @else
                <form class="form-ajax" action="/branch" method="POST">
                @csrf()
                @endif
                    <div class="panel-body">
                        <th>ชื่อสาขา : </th>
                        <input type="text" name="bran_name" class="form-control" value="{{isset($branch)?$branch->bran_name:''}}"/>
                        <th>หลักสูตร:</th>
                        <input type="text" name="con_id" class="form-control" value="{{isset($branch)?$branch->con_id:''}}"/> 
                    </div>
                    <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                </form>
        </div>
    </div>  
</div>

@endsection