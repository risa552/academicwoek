@extends('academic-layout') 
@section('title','เพิ่มข้อมูลวิชา')
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
                <!-- <li class="breadcrumb__group">
                <a href="/subject" class="breadcrumb__point r-link">ข้อมูลวิชา</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li>
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">เพิ่มข้อมูลวิชา</span>
                </li> -->
            </ol>
            </nav>
        </div>
    <div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-info"> 
                 <a herf="/detail" กลับหน้าหลัก> </a>
                <div class="panel-heading">
                    @if(isset($items))
                    รายละเอียด : {{$items->detailpro_id}}
                    @else
                    เพิ่มข้อมูลรายละเอียด
                    @endif
                    <a class="btn btn-default pull-right" href="/detail" style="padding-top: 2px;padding-bottom: 2px;" data-toggle="tooltip" title=""><i class="fa fa-close"></i></a>

                </div>
                @if(isset($items))
                <form action="/detail/{{$items->detailpro_id}}" class="form-ajax" method="PUT">
                    <input type="hidden" value="put" name="_mathods">
                    @csrf()
                @else
                <form class="form-ajax" action="/detail" method="POST">
                @csrf()
                @endif
                <div class="panel-body">
                       
                        <div class="form-group col-md-6">
                            <label >ภาคเรียน:</label>
                            <select class="form-control" name="term_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($term as $index => $row1)
                                <option value ="{{$row1->term_id}}" {{isset($items)&& $items->term_id==$row1->term_id?'selected':''}}>
                                {{$row1->term_name}}/{{$row1->term_year}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label >วิชา:</label>
                            <select class="form-control" name="sub_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($subject as $index => $row2)
                                <option value ="{{$row2->sub_id}}" {{isset($items)&& $items->sub_id==$row2->sub_id?'selected':''}}>
                                 {{$row2->sub_code}} {{$row2->sub_name}} <br> {{$row2->sub_name_eng}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                    <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                </div>                
                </form>
        </div>
    </div>  
</div>

@endsection