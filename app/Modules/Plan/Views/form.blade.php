@extends('academic-layout') 
@section('title','เพิ่มการลงทะเบียน')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default"> 
                 <a herf="#" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                    การลงทะเบียน : ชื่อ 
                </div>
                @if(isset($teacher))
                <form action="#" class="form-ajax" method="PUT">
                    <input type="hidden" value="put" name="_mathods">
                    @csrf()
                @else
                <form class="form-ajax" action="/educate" method="POST">
                @csrf()
                @endif
               

                <div class="panel-body">
                    <div class="form-group">
                        <label >ภาคเรียน : </label>
                    </div>
                    <div class="form-group">
                        <label >ชื่อวิชา : </label>
                    </div>
                    <div class="form-group">
                        <label >สถานะ :</label>
                    </div>
                    
                   
                    <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                </form>
        </div>
    </div>  
</div>

@endsection