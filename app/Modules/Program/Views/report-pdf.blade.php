
                    <h5 style="text-align:center;">แผนการเรียน</h5>
                    <h4 style="border:1px solid #ccc;padding:5px;text-align:center;">
                    หลักสูตร : {{$course}}   สาขา : {{$branche}}   ปีการศึกษา : {{$group_year}}  ใช้หลักสูตรปรับปรุงปี  : {{$cou_year}}
                    </h4>
                    
                    <table width=100% border="1" cellspacing="0" bordercolor="black"  class="table table-bordered">  
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
                                <th style="white-space: nowrap; overflow:hidden; text-overflow:ellipsis">รายชื่อวิชา</th>
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
                                    <td>{{$program_1[$i]->sub_name}}<br>{{$program_1[$i]->sub_nameeng}}</td>
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
                                    <td>{{$program_2[$i]->sub_name}}<br>{{$program_2[$i]->sub_nameeng}}</td>
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
                            <th  colspan='1' rowspan='2'></th>
                            <th style="text-align:center;" colspan='1'>รวม</th>
                            <th > {{$sumtheory1}}  </th>
                            <th> {{$sumpractice1}}</th>

                            <th colspan='1' rowspan='2'></th>
                            <th style="text-align:center;" colspan='1'>รวม</th>
                            <th > {{$sumtheory2}}  </th>
                            <th> {{$sumpractice2}}</th>
                        </tr>
                        <tr>
                            <th style="text-align:center;" colspan='1'>รวมทั้งสิ้น</th>
                            <th style="text-align:center;" colspan='2' >{{$sumtheory1+$sumpractice1}} </th>

                            <th style="text-align:center;" colspan='1'>รวมทั้งสิ้น</th>
                            <th style="text-align:center;" colspan='2' >{{$sumtheory2+$sumpractice2}} </th>
                        </tr>
                    
                        </thead>
                    @endif
                @endforeach

                    </table>
