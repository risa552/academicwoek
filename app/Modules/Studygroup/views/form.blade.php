@extends('academic-layout') 
@section('title','เพิ่มข้อมูลกลุ่มเรียน')
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
                <a href="/studygroup" class="breadcrumb__point r-link">ข้อมูลกลุ่มเรียน</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li>
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">เพิ่มข้อมูลกลุ่มเรียน</span>
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
                <div class="panel-heading">
                        @if(isset($group))
                        กลุ่มเรียน : {{$group->group_name}}
                        @else
                        เพิ่มกลุ่มเรียน
                        @endif
                    <a class="btn btn-default pull-right" href="/studygroup" style="padding-top: 2px;padding-bottom: 2px;" data-toggle="tooltip" title=""><i class="fa fa-close"></i></a>

                </div>
                    @if(isset($group))
                    <form action="/studygroup/{{$group->group_id}}" class="form-ajax" method="put">
                        <input type="hidden" value="put" name="_mathods">
                        @csrf()
                    @else
                    <form class="form-ajax" action="/studygroup" method="POST">
                    @csrf()
                    @endif
                    <div class="panel-body">
                            <div class="form-group">
                                <label for="email">ชื่อกลุ่มรียน:</label>
                                <input type="text" name="group_name" class="form-control" value="{{isset($group)?$group->group_name:''}}"/> 
                            </div>
                            <div class=" col-md-6">
                                <label >ปีที่เข้าศึกษา:</label>
                                <select name="group_year" class="form-group">
                                    @for($i=date('Y');$i>date('Y')-3;$i--)
                                    <option {{isset($group) && $group->group_year==($i+543)?'select':''}} value="{{($i+543)}}">{{($i+543)}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                            <label>ประเภท:</label>
                                    <div class="form-group" >
                                        <input name="group_type" type="radio" {{isset($group) && $group->group_type=='ปกติ'?'checked':''}} value="ปกติ"/>ปกติ
                                        <input name="group_type" type="radio" {{isset($group) && $group->group_type=='สมทบ'?'checked':''}} value="สมทบ"/>สมทบ
                                    </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label >สาขาวิชา:</label>
                                <select style="width:150px;" name="bran_id">
                                    <option value="all">
                                        ทั้งหมด
                                    </option>
                                @foreach($branch as $index => $row1)
                                    <option value ="{{$row1->bran_id}}" {{isset($group)&& $group->bran_id==$row1->bran_id?'selected':''}}>
                                        {{$row1->bran_name}}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label >ระดับ:</label>
                                <select style="width:150px;" name="degree_id">
                                    <option value="all">
                                        ทั้งหมด
                                    </option>
                                @foreach($degree as $index => $row2)
                                    <option value ="{{$row2->degree_id}}" {{isset($group)&& $group->degree_id==$row2->degree_id?'selected':''}}>
                                        {{$row2->degree_name}}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label >อาจารย์:</label>
                                <select style="width:150px;" name="teach_id">
                                    <option value="all">
                                        ทั้งหมด
                                    </option>
                                @foreach($teach as $index => $teacher)
                                    <option value ="{{$teacher->teach_id}}" {{isset($group)&& $group->teach_id==$teacher->teach_id?'selected':''}}>
                                        {{$teacher->first_name}}  {{$teacher->last_name}}
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
</div>

@endsection