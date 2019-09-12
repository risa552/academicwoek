@extends('academic-layout') 
@section('title','ข้อมูลแผนการเรียน')
@section('content')
<div class="container">
    <div class="col-md-10">
        <div class="page__section">
            <nav class="breadcrumb breadcrumb_type5" aria-label="Breadcrumb">
            <ol class="breadcrumb__list r-list">
                <li class="breadcrumb__group">
                <a href="/" class="breadcrumb__point r-link"><i class="fa fa-home" aria-hidden="true"></i></a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                <!-- </li>
                <li class="breadcrumb__group">
                <a href="/professor" class="breadcrumb__point r-link">ข้อมูลอาจารย์</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li> -->
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">แผนการเรียน</span>
                </li>
            </ol>
            </nav>
        </div>
    <div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            
                <div class="panel-heading">
                    แผนการเรียน
                    <a class="btn btn-default pull-right" href="/program" style="padding-top: 2px;padding-bottom: 2px;" data-toggle="tooltip" title=""><i class="fa fa-close"></i></a>
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
                                <th style="white-space: nowrap; overflow:hidden; text-overflow:ellipsis">รหัสวิชา</th>
                                <th  style="white-space: nowrap; overflow:hidden; text-overflow:ellipsis">รายชื่อวิชา</th>
                                <th >ท.</th>
                                <th >ป.</th>
                                <th style="white-space: nowrap; overflow:hidden; text-overflow:ellipsis">รหัสวิชา</th>
                                <th  style="white-space: nowrap; overflow:hidden; text-overflow:ellipsis">รายชื่อวิชา</th>
                                <th >ท.</th>
                                <th >ป.</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php 
                        $program_1 = null;
                        $program_2 = null;
                        $max_length = 0;
                        if(isset($program[1]) && isset($program[2]))
                        {
                            $program_1 = $program[1]['subjects'];
                            $program_2 = $program[2]['subjects'];

                            if(count($program[1]['subjects']) > count($program[2]['subjects']))
                            {
                                $max_length = count($program[1]['subjects']);
                            }
                            else
                            {
                                $max_length = count($program[2]['subjects']);
                            }
                        }
                        elseif(isset($program[1]))
                        {
                            $max_length = count($program[1]['subjects']);
                            $program_1 = $program[1]['subjects'];
                            $program_2 = null;
                        }
                        elseif(isset($program[2]))
                        {
                            $max_length = count($program[2]['subjects']);
                            $program_2 = $program[2]['subjects'];
                            $program_1 = null;
                        }
                    ?>
                    @if($max_length > 0)
                        @for($i=0;$i<$max_length;$i++)
                            <tr>
                                @if(!empty($program_1 && isset($program_1[$i])))
                                    <td>{{$program_1[$i]->sub_code}}</td>
                                    <td>{{$program_1[$i]->sub_name}}<br>{{$program_1[$i]->sub_nameeng}}</td>
                                    <td>{{$program_1[$i]->theory}}</td>
                                    <td>{{$program_1[$i]->practice}}</td>
                                @else
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                @endif
                                @if(!empty($program_2 && isset($program_2[$i])))
                                    <td>{{$program_2[$i]->sub_code}}</td>
                                    <td>{{$program_2[$i]->sub_name}}<br>{{$program_2[$i]->sub_nameeng}}</td>
                                    <td>{{$program_2[$i]->theory}}</td>
                                    <td>{{$program_2[$i]->practice}}</td>
                                @else
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                @endif
                            </tr>
                        @endfor
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