@extends('academic-layout') 
@section('title','เพิ่มข้อมูลกลุ่มวิชา')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">  
                <div class="panel-heading">
                        @if(isset($subjectgroup))
                        กลุ่มวิชา : {{$subjectgroup->subgroup_name}}
                        @else
                        เพิ่มกลุ่มวิชา
                        @endif
                    <a class="btn btn-default pull-right" href="/subjectgroup" style="padding-top: 2px;padding-bottom: 2px;" data-toggle="tooltip" title=""><i class="fa fa-close"></i></a>

                </div>
                    @if(isset($subjectgroup))
                    <form action="/subjectgroup/{{$subjectgroup->subgroup_id}}" class="form-ajax" method="PUT">
                        <input type="hidden" value="put" name="_mathods">
                        @csrf()
                    @else
                    <form class="form-ajax" action="/subjectgroup" method="POST">
                    @csrf()
                    @endif
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="email">ชื่อกลุ่มวิชา:</label>
                             <input type="text" name="subgroup_name" class="form-control" value="{{isset($subjectgroup)?$subjectgroup->subgroup_name:''}}"/> 
                        </div>
                    </div>
                    <button class="bth" style="margin-left:100px; margin-bottom:10px;"> <i class="fa fa-check" aria-hidden="true"> ยืนยัน</i></button>
                </form>
            </div>
        </div>
    </div>  
</div>
@endsection 