<nav class="navbar navbar-default nav-bg-color">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    <img class="mylogo" src="http://bait.rmutsb.ac.th/bait/images/logobait.png"/>
                </a>
            </div>
            <ul class="nav navbar-nav pull-right" style="margin-top: 11px">
                <li class="nav-menu"><a href="/">หน้าแรก</a></li>
                <li class="nav-menu"><a href="/enrolment">ลงทะเบียน</a></li>
                <li class="dropdown nav-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                    การบริหารจัดการ<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="sub-nav-menu"><a href="/course">หลักสูตร</a></li>
                        <li class="sub-nav-menu"><a href="/studygroup">กลุ่มเรียน</a></li>
                        <li class="sub-nav-menu"><a href="/degree">ระดับ</a></li>
                        <li class="sub-nav-menu"><a href="/branch">สาขาวิชา</a></li>
                        <li class="sub-nav-menu"><a href="/subjectgroup">กลุ่มวิชา</a></li>
                        <li class="sub-nav-menu"><a href="/subject">วิชา</a></li>
                        <li class="sub-nav-menu"><a href="/term">ภาคเรียน</a></li>
                        <li class="sub-nav-menu"><a href="/student">นักศึกษา</a></li>
                        <li class="sub-nav-menu"><a href="/professor">อาจารย์</a></li>
                        <li class="sub-nav-menu"><a href="/admin">ผู้ใช้งาน</a></li>
                    </ul>
                </li>
                <li class="nav-menu"><a href="/program">แผนการเรียน</a></li>
                <li class="nav-menu"><a href="/exam">การส่งข้อสอบ</a></li>
                <!--<li class="nav-menu"><a href="/educate">ภาระการสอน</a></li>-->
                <li class="dropdown nav-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                    ภาระการสอน<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="sub-nav-menu"><a href="/educate">ภาระการสอน</a></li>
                        <li class="sub-nav-menu"><a href="/plan">รายงานภาระการสอน</a></li>
                    </ul>
                </li>
                <li class="dropdown nav-menu">                
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                        <i class="fa fa-user" aria-hidden="true">{{CurrentUser::user()->first_name}} </i><span class="caret"></span>

                    </a>
                    <ul class="dropdown-menu">
                        <li class="sub-nav-menu"><a href="/logout">ออกจากระบบ</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>