@extends('academic-layout') 
@section('title','การส่งข้อสอบ')
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
                <a href="/educate" class="breadcrumb__point r-link">ข้อมูลภาระการสอน</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li> -->
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">การส่งข้อสอบ</span>
                </li>
            </ol>
            </nav>
        </div>
    <div>
</div>
<div class="container">
    <div class="row">
    <div class="col-md-3">
        <div class="panel panel-info">
            <div class="panel-heading">ค้นหาข้อสอบ</div>
            <div class="panel-body">
                <form action="/examprofessor">
                    <div class="form-group">
                        <label >ภาคเรียน:</label>
                        <select class="form-control" name="term_id">
                            <option value="all">
                                ทั้งหมด
                            </option>
                        @foreach($rom as $index => $row2)
                            <option value ="{{$row2->term_id}}" {{Input::get('term_id')==$row2->term_id?'selected':''}}>
                                {{$row2->term_name}}/{{$row2->term_year}}
                            </option>
                        @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div> 

        <div class="col-md-9">
        <div class="panel panel-info">
                <div class="panel-heading">
                รายการการส่งข้อสอบ
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ชื่อวิชา</th>
                                <th>กลุ่มเรียน</th>
                                <th>ภาคเรียน</th>
                                <th style="width:150px;">ไฟล์ข้อสอบกลางภาค</th>
                                <th></th>
                                <th style="width:150px;">ไฟล์ข้อสอบปลายภาค</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($exam as $index => $row)
                                <tr>
                                    <td>{{$index+$exam->FirstItem()}}</td>
                                    <td>{{$row->sub_code}} {{$row->sub_name}} <br> {{$row->sub_name_eng}}</td>
                                    <td>{{$row->group_name}}</td>
                                    <td>{{$row->term_name}}/{{$row->term_year}}</td>
                                    <td><a target="_blank" href="{{$row->file_mid}}">{{$row->file_mid?'Download':''}}</a></td>
                                    <td>
                                        <button type="button" data-term="file_mid" data-programid="{{$row->educate_id}}" data-ext="doc,docx,xls,xlsx,pdf" data-url="/upload-exam" data-callback="exam_success" class="btn btn-default upload-file">
                                        <i class="fa fa-file-text" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                    <td><a target="_blank" href="{{$row->file_final}}">{{$row->file_final?'Download':''}}</a></td>
                                     <td>
                                        <button type="button"  data-term="file_final" data-programid="{{$row->educate_id}}" data-ext="doc,docx,xls,xlsx,pdf" data-url="/upload-exam" data-callback="exam_success" class="btn btn-default upload-file">
                                        <i class="fa fa-file-text" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $exam->render()  !!}
                </div>
            </div>
        </div>
    </div>  
</div>

@endsection
@push('scripts')
    <script>
        function exam_success(){
            window.location.reload();
        }
     </script>   
@endpush