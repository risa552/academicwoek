@extends('academic-layout') 
@section('title','การส่งข้อสอบ')
@section('content')
<div class="container">
    <div class="row">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">ค้นหาข้อสอบ</div>
            <div class="panel-body">
                <form action="/examprofessor">
                    <div class="form-group">
                        <label for="keyword"></label>
                        <input type="text" name="keyword" class="form-control" value="{{Input::get('keyword')}}">
                    </div>
                    <div class="form-group">
                        <label >ภาคเรียน:</label>
                        <select style="width:150px;" name="term_id">
                            <option value="all">
                                ทั้งหมด
                            </option>
                        @foreach($rom as $index => $row2)
                            <option value ="{{$row2->term_id}}" {{Input::get('term_id')==$row2->term_id?'selected':''}}>
                                {{$row2->term_name}}
                            </option>
                        @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default">ยืนยัน</button>
                </form>
            </div>
        </div>
    </div> 

        <div class="col-md-9">
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
                                <th>ไฟล์ข้อสอบกลางภาค</th>
                                <th></th>
                                <th>ไฟล์ข้อสอบปลายภาค</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($exam as $index => $row)
                                <tr>
                                    <td>{{$row->sub_code}}</td>
                                    <td>{{$row->sub_name}}</td>
                                    <td><a target="_blank" href="{{$row->file_mid}}">{{$row->file_mid}}</a></td>
                                    <td>
                                        <button type="button" data-term="file_mid" data-programid="{{$row->program_id}}" data-ext="doc,docx,xls,xlsx,pdf" data-url="/upload-exam" data-callback="exam_success" class="btn btn-default upload-file">
                                        <i class="fa fa-file-text" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                    <td><a target="_blank" href="{{$row->file_final}}">{{$row->file_final}}</a></td>
                                     <td>
                                        <button type="button"  data-term="file_final" data-programid="{{$row->program_id}}" data-ext="doc,docx,xls,xlsx,pdf" data-url="/upload-exam" data-callback="exam_success" class="btn btn-default upload-file">
                                        <i class="fa fa-file-text" aria-hidden="true"></i>
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