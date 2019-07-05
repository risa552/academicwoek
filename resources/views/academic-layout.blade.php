<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/academic.css">
</head>
<body>
    <nav class="navbar navbar-default nav-bg-color">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    <img class="mylogo" src="http://bait.rmutsb.ac.th/bait/images/logobait.png"/>
                </a>
            </div>
            <ul class="nav navbar-nav pull-right" style="margin-top: 11px">
                <li class="nav-menu"><a href="#">หน้าแรก</a></li>
                <li class="nav-menu"><a href="#">ลงทะเบียน</a></li>
                <li class="nav-menu"><a href="#">หลักสูตร</a></li>
                <li class="nav-menu"><a href="#">แผนการเรียน</a></li>
                <li class="nav-menu"><a href="#">กลุ่มวิชา</a></li>
                <li class="nav-menu"><a href="#">การส่งข้อสอบ</a></li>

                <li class="dropdown nav-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                        <i class="fa fa-user" aria-hidden="true"> ริสา เบ็ญมูซา</i><span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="sub-nav-menu"><a href="#">ข้อมูลทั่วไป</a></li>
                        <li class="sub-nav-menu"><a href="#">ข้อมูลการศึกษา</a></li>
                        <li class="sub-nav-menu"><a href="#">ตารางเรียน</a></li>
                        <li class="sub-nav-menu"><a href="#">ตารางสอบ</a></li>
                    </ul>
                </li>
                <li><a href="#"></a></li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid">
         @yield('content')
    </div>
<script src="/assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
</body>
</html>