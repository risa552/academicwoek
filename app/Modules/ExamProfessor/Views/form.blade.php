@extends('academic-layout') 
@section('title','การส่งข้อสอบ')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
        <div class="panel panel-default">
                <div class="panel-heading">
                รายการการส่งข้อสอบ
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>รหัสวิชา</th>
                                <th>ชื่อวิชา</th>
                                <th>ไฟล์ข้อสอบ</th>
                                <th style="width:110px">ส่งข้อสอบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($exam as $index => $row)
                                <tr>
                                    <td>{{$row->sub_code}}</td>
                                    <td>{{$row->sub_name}}</td>
                                    <td><a target="_blank" href="{{$row->file}}">{{$row->file}}</a></td>
                                    <td>
                                        <button type="button" data-programid="{{$row->program_id}}" data-ext="doc,docx,xls,xlsx,pdf" data-url="/upload-exam" data-callback="exam_success" class="btn btn-default upload-file">
                                            เลือกไฟล์
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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