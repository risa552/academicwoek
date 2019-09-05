@extends('academic-layout') 
@section('title','ข้อมูลแผนการเรียน')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">ค้นหาแผนการเรียน</div>
                <div class="panel-body">
                    <form action="/program">
                        <!--<div class="form-group">
                            <label for="keyword">แผนการเรียน</label>
                            <input type="text" name="keyword" class="form-control" value="{{Input::get('keyword')}}">
                        </div>-->
                        <div class="form-group">
                            <label >กลุ่มเรียน:</label>
                            <select style="width:150px;" name="group_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($items2 as $index => $rowm)
                                <option value ="{{$rowm->group_id}}" {{Input::get('group_id')==$rowm->group_id?'selected':''}}> 
                                    {{$rowm->group_name}}
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
                                <option value ="{{$row2->term_id}}" {{Input::get('term_id')==$row2->term_id?'selected':''}}>
                                    {{$row2->term_name}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                       <!-- <div class="form-group">
                            <label >วิชา:</label>
                            <select style="width:150px;" name="sub_id">
                                <option value="all">
                                    ทั้งหมด
                                </option>
                            @foreach($items4 as $index => $row3)
                                <option value ="{{$row3->sub_id}}" {{Input::get('sub_id')==$row3->sub_id?'selected':''}}>
                                    {{$row3->sub_name}}
                                </option>
                            @endforeach
                            </select>
                        </div>-->
                        <button type="submit" class="btn btn-default">ยืนยัน</button>
                    </form>
                </div>
            </div>
        </div> 

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    รายการข้อมูลแผนการเรียน
                    <a href="/program/create" class="pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มข้อมูลแผนการเรียน</a>
                </div>
                <div class="panel-body">  
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>กลุ่มเรียน</th>
                                <th>ภาคเรียน</th>
                                <th>วิชา</th>
                                <th style="width:150px">แก้ไขรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $index => $row)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$row->group_name}}</td>
                                    <td>{{$row->term_name}}/{{$row->year}}</td>
                                    <td>{{$row->sub_name}}</td>
                                    <td>
                                        <div class="btn-group">
                                          <!--  <a class="fa fa-file-text-o btn btn-success" aria-hidden="true" href="/program/plan"></a> -->
                                            <a class="fa fa-pencil-square btn btn-info" aria-hidden="true" href="/program/{{$row->program_id}}"></a>
                                            <a class="fa fa-trash delete-item btn btn-danger" aria-hidden="true" href="/program/{{$row->program_id}}"></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!--<ul class="pagination">
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                    </ul> -->
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="panel panel-default">
            
                <div class="panel-heading">
                    แผนการเรียน
                    <a  class="btn btn-default fa fa-print pull-right" aria-hidden="true"></a>
                </div>
            <form>
                <div class="panel-body">
                    <h5 style="text-align:center;">แผนการเรียน</h5>
                    <h4 style="border:1px solid #ccc;padding:5px;text-align:center;">สาขา : {{$branche}}</h4>
                    
                    <table class="table table-bordered">  
                @foreach($programs as $program)
                        <thead>
                            <tr>
                                <th colspan='4' >
                                @if(isset($program[1]))
                                ปีการศึกษา {{$program[1]['numyear']}} ภาคเรียน :   {{$program[1]['name']}}
                                @endif
                                </th>
                                <th colspan='4' >
                                @if(isset($program[2]))
                                ปีการศึกษา {{$program[2]['numyear']}} ภาคเรียน :   {{$program[2]['name']}}
                                @endif
                                </th>
                            </tr>
                            <tr>
                                <th>รหัสวิชา</th>
                                <th>รายชื่อวิชา</th>
                                <th>ชม.ทฤษฏี</th>
                                <th>ชม.ปฏิบัติ</th>
                                <th>รหัสวิชา</th>
                                <th>รายชื่อวิชา</th>
                                <th>ชม.ทฤษฏี</th>
                                <th>ชม.ปฏิบัติ</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php 
                        $program_1 = null;
                        $program_2 = null;
                        if(isset($program[1]) && isset($program[2]))
                        {
                            if(count($program[1]['subjects']) > count($program[2]['subjects']))
                            {
                                $program_1 = $program[1]['subjects'];
                                $program_2 = $program[2]['subjects'];
                            }
                            else
                            {
                                $program_1 = $program[1]['subjects'];
                                $program_2 = $program[2]['subjects'];
                            }
                        }
                        elseif(isset($program[1]))
                        {
                            $program_1 = $program[1]['subjects'];
                            $program_2 = null;
                        }
                        else
                        {
                            $program_1 = $program[2]['subjects'];
                            $program_2 = null;
                        }
                    ?>
                    @if(!empty($program_1))
                        @foreach($program_1 as $index => $row1)
                            <tr>
                                <td>{{$row1->sub_code}}</td>
                                <td>{{$row1->sub_name}}</td>
                                <td>{{$row1->theory}}</td>
                                <td>{{$row1->practice}}</td>
                            @if(!empty($program_2))
                                <td>{{$program_2[$index]->sub_code}}</td>
                                <td>{{$program_2[$index]->sub_name}}</td>
                                <td>{{$program_2[$index]->theory}}</td>
                                <td>{{$program_2[$index]->practice}}</td>
                            @else
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            @endif
                            </tr>
                        @endforeach
                    @endif
                        </tbody>
                @endforeach

                    </table>
                </div>
            </form>
                
            </div>
        </div>
    </div>  
</div>
@endsection