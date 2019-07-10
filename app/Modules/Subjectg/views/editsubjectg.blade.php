@extends('academic-layout') 
@section('title','แก้ไขกลุ่มวิชา')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">  
            <div class="panel-heading">กลุ่มวิชา</div>
                <form class="form-horizontal" action="/subjectg" style="margin-top:15px;">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">รหัสกลุ่มวิชา:</label>
                        <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">ชื่อกลุ่มวิชา:</label>
                        <div class="col-sm-10"> 
                        <input type="password" class="form-control" id="pwd" placeholder="Enter password">
                        </div>
                    </div>
                   
                    <div class="form-group" > 
                        <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-secondary"><a  href="subjectg" class="fa fa-arrow-left" aria-hidden="true"> back</a></button>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>

@endsection