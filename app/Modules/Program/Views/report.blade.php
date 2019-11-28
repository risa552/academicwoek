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
                </li>
                <li class="breadcrumb__group">
                <a href="/preprogram" class="breadcrumb__point r-link">ข้อมูลแผนการเรียน</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li>
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">รายงานแผนการเรียน</span>
                </li>
            </ol>
            </nav>
        </div>
    <div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    รายงานแผนการเรียน  {{$group_name}}
                    <a class="btn btn-default pull-right" href="/preprogram" style="padding-top: 2px;padding-bottom: 2px;" data-toggle="tooltip" title=""><i class="fa fa-close"></i></a>
                    <a  class="btn btn-default fa fa-print pull-right" href="/print-program/{{$group_id}}" aria-hidden="true"></a>
                </div>
            <form>
                <div class="panel-body">
                    <h5 style="text-align:center;">แผนการเรียน</h5>
                    <h4 style="border:1px solid #ccc;padding:5px;text-align:center;">
                    หลักสูตร : {{$course}}   สาขา : {{$branche}}   ปีการศึกษา : {{$group_year}}  ใช้หลักสูตรปรับปรุงปี  : {{$cou_year}}
                    </h4>
                    
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
                    <?php
                        $sumtheory1=0;
                        $sumpractice1=0;
                        $sumtheory2=0;
                        $sumpractice2=0;
                    ?>
                        @for($i=0;$i<$max_length;$i++)
                            <tr>
                                @if(!empty($program_1 && isset($program_1[$i])))
                                    <td>{{$program_1[$i]->sub_code}}</td>
                                    <td>{{$program_1[$i]->sub_name}}<br>{{$program_1[$i]->sub_name_eng}}</td>
                                    <td>{{$program_1[$i]->theory}}</td>
                                    <td>{{$program_1[$i]->practice}}</td>
                                    <?php 
                                    $sumtheory1+=is_numeric($program_1[$i]->theory)?$program_1[$i]->theory:0;
                                    $sumpractice1+=is_numeric($program_1[$i]->practice)?$program_1[$i]->practice:0;
                                    ?>
                                @else
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                @endif
                                @if(!empty($program_2 && isset($program_2[$i])))
                                    <td>{{$program_2[$i]->sub_code}}</td>
                                    <td>{{$program_2[$i]->sub_name}}<br>{{$program_2[$i]->sub_name_eng}}</td>
                                    <td>{{$program_2[$i]->theory}}</td>
                                    <td>{{$program_2[$i]->practice}}</td>
                                    <?php 
                                    $sumtheory2+=is_numeric($program_2[$i]->theory)?$program_2[$i]->theory:0;
                                    $sumpractice2+=is_numeric($program_2[$i]->practice)?$program_2[$i]->practice:0;
                                    ?>
                                @else
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                @endif
                            </tr>
                        @endfor
                        </tbody>
                        <thead>
                        <tr>
                            <th style="text-align:right;" colspan='2'>รวม</th>
                            <th > {{$sumtheory1}}  </th>
                            <th> {{$sumpractice1}}</th>

                            <th style="text-align:right;" colspan='2'>รวม</th>
                            <th > {{$sumtheory2}}  </th>
                            <th> {{$sumpractice2}}</th>
                        </tr>
                        <tr>
                            <th style="text-align:right;" colspan='2'>รวมทั้งสิ้น</th>
                            <th style="text-align:center;" colspan='2' >{{$sumtheory1+$sumpractice1}} </th>

                            <th style="text-align:right;" colspan='2'>รวมทั้งสิ้น</th>
                            <th style="text-align:center;" colspan='2' >{{$sumtheory2+$sumpractice2}} </th>
                        </tr>
                        </thead>
                        <td colspan='8' style="padding:10px;">       </td>
                    @endif
                @endforeach

                    </table>
                </div>
            </form>
                
            </div>
        </div>
    </div>  
</div>
@endsection