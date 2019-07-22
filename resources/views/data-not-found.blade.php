@extends('academic-layout') 
@section('title','ไม่พบรายการที่ต้องการค่ะ')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default"> 
                <div class="panel-heading"> ไม่พบรายการที่ต้องการ</div>
                <div class="panel-body">
                   <p class="text-center" style="padding:50px">
                        ขออภัยระบบไม่พบข้อมูลที่ท่านต้องการ กรุณาตรวจสอบความถูกต้องด้วยค่ะ
                        <br/>
                        <a href="{{$back_url}}">กลับ
                   </p>
                </div>
            </div>
        </div>
    </div>  
</div>

@endsection