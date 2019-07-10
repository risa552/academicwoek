@extends('academic-layout') 
@section('title','แผนการเรียน')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                
                        <div class="form-group">
                            <label for="email">รหัสวิชา</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="email">ชื่อวิชา</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="email">ปีการศึกษา</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="email">ภาคเรียน</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        
                        <button type="submit" class="btn btn-default">ค้นหา</button>
                    </form>
                </div>
            </div>

        </div> 
    
            
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                แผนการเรียนึ
                 <a href="/subjectg/table" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มแผนการเรียน</a>
            </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>รหัสวิชา</th>
                                <th>ชื่อวิชา</th>
                                <th>ปีการศึกษา</th>
                                <th>ภาคเรียน</th>
                                <th style="width:110px">รายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.1</td>
                                <td>พลศึกษาและนันทนาการ</td>
                                <td>พลศึกษาและนันทนาการ</td>
                                <td>พลศึกษาและนันทนาการ</td>
                                <td>
                            
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info"><i class="fa fa-pencil-square" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                 <td>1.2</td>
                                 <td>ภาษา</td>
                                 <td>พลศึกษาและนันทนาการ</td>
                                 <td>พลศึกษาและนันทนาการ</td>
                                 
                                 <td>
                            
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info"><i class="fa fa-pencil-square" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </div>
                                </td>
                            </tr>
                
                            
    @endsection.