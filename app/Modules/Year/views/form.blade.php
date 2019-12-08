@extends('academic-layout') 
@section('title','เพิ่มข้อมูลปรการศึกษา')
@section('content')
<div class="container">
    <div class="col-md-10">
        <div class="page__section">
            <nav class="breadcrumb breadcrumb_type5" aria-label="Breadcrumb">
            <ol class="breadcrumb__list r-list">
                <li class="breadcrumb__group">
                <a href="/" class="breadcrumb__point r-link"><i class="fa fa-home" aria-hidden="true"></i></a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li>
                <li class="breadcrumb__group">
                <a href="/year" class="breadcrumb__point r-link">ข้อมูลระดับ</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li>
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">รายงานเพิ่มข้อมูลระดับ</span>
                </li>
            </ol>
            </nav>
        </div>
    <div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-info"> 
                 <a herf="/year" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                    @if(isset($years))
                    ปีการศึกษา : {{$years->year_name}}
                    @else
                    เพิ่มข้อมูลปีการศึกษา
                    @endif
                    <a class="btn btn-default pull-right" href="/year" style="padding-top: 2px;padding-bottom: 2px;" data-toggle="tooltip" title=""><i class="fa fa-close"></i></a>

                </div>
                @if(isset($years))
                <form action="/year/{{$years->year_id}}" class="form-ajax" method="PUT">
                    <input type="hidden" value="put" name="_mathods">
                    @csrf()
                @else
                <form class="form-ajax" action="/year" method="POST">
                @csrf()
                @endif
                <div class="panel-body ">
                    <label>ปีการศึกษา:</label>
                    <select  name="year_name" class="form-control">
                        @for($i=date('Y')+3;$i>date('Y')-3;$i--)
                        <option {{isset($years) && $years->year_name==($i+543)?' selected ':''}} value="{{($i+543)}}">{{($i+543)}}</option>
                        @endfor
                    </select>
                </div>
                    <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                </form>
        </div>
    </div>  
</div>

@endsection