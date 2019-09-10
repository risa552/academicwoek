@extends('academic-layout') 
@section('title','เพิ่มข้อมูลแผนการเรียนน')
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
                <a href="/program" class="breadcrumb__point r-link">แผนการเรียน</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li>
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">รายงานเพิ่มข้อมูลแผนการเรียน</span>
                </li>
            </ol>
            </nav>
        </div>
    <div>
</div>
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
                    <a class="btn btn-default pull-right" href="/program" style="padding-top: 2px;padding-bottom: 2px;" data-toggle="tooltip" title=""><i class="fa fa-close"></i></a>

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
                        <label >กลุ่มเรียน:</label>
                        <select style="width:150px;" name="group_id">
                            <option value="all">
                                ทั้งหมด
                            </option>
                        @foreach($items2 as $index => $row1)
                            <option value ="{{$row1->group_id}}" {{isset($items)&& $items->group_id==$row1->group_id?'selected':''}}> 
                                {{$row1->group_name}}
                            </option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label >ภาคเรียน:</label>
                        <select style="width:150px;" name="term_id">
                            <option value="all">
                                ทั้งหมด
                            </option>
                        @foreach($items3 as $index => $row2)
                            <option value ="{{$row2->term_id}}" {{isset($items)&& $items->term_id==$row2->term_id?'selected':''}}>
                                {{$row2->term_name}}/{{$row2->year}}
                            </option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label >วิชา:</label>
                        <select style="width:150px;" name="sub_id">
                            <option value="all">
                                ทั้งหมด
                            </option>
                        @foreach($items4 as $index => $row3)
                            <option value ="{{$row3->sub_id}}" {{isset($items)&& $items->sub_id==$row3->sub_id?'selected':''}}>
                                     {{$row3->sub_code}}  {{$row3->sub_name}}
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