@extends('academic-layout') 
@section('title','เพิ่มข้อมูลระดับ')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">  
            <div class="panel-heading">เพิ่มข้อมูลระดับ</div>
                <form class="form-horizontal" action="/action_page.php" style="margin-top:15px;">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">รหัสระดับ:</label>
                        <div class="col-sm-10"> 
                        <input type="password" class="form-control" id="pwd" placeholder="Enter password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">ชื่อระดับ:</label>
                        <div class="col-sm-10"> 
                        <input type="password" class="form-control" id="pwd" placeholder="Enter password">
                        </div>
                    </div>
                    <div class="form-group"> 
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-secondary"><a  href="/degree" class="fa fa-arrow-left" aria-hidden="true"> back</a></button>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>  
</div>

@endsection