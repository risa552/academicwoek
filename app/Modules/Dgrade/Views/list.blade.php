@extends('academic-layout') 
@section('title','รายงานการออกเกรด')
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
                <a href="/grade" class="breadcrumb__point r-link">รายงานเกรด</a>
                <span class="breadcrumb__divider" aria-hidden="true">›</span>
                </li>
                <li class="breadcrumb__group">
                <span class="breadcrumb__point" aria-current="page">รายงานการออกเกรด</span>
                </li>
            </ol>
            </nav>
        </div>
    <div>
</div>
<div class="container">
    <div class="row" >
        <form class="form-ajax" method="POST" action="/dgrade">
            <div class="col-md-9"  >
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <a href="/grade"><i class="fa fa-arrow-left" aria-hidden="true"></i> กลับ</a>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ชื่อนักศึกษา</th>
                                    <th>คะแนน</th> 
                                    <th>เกรด</th>
                                </tr>
                            </thead>    
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td> {{$row->first_name}} {{$row->last_name}}</td>
                                    <td>
                                        <input type="text" value="{{$row->score}}" name="score[{{$row->enro_id}}]"  style="width:100px;" class="score-grade"/>
                                    </td>
                                    <td>
                                    <input type="text" readonly style="width:100px;" value="{{$row->grade}}" name="grade[{{$row->enro_id}}]" class="grade-input"/>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
        
    </div>  
</div>

@endsection
