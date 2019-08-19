<nav class="navbar navbar-default nav-bg-color">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    <img class="mylogo" src="http://bait.rmutsb.ac.th/bait/images/logobait.png"/>
                </a>
            </div>
            <ul class="nav navbar-nav pull-right" style="margin-top: 11px">
                <li class="nav-menu"><a href="#">หน้าแรก</a></li>
                <li class="nav-menu"><a href="/grade">ออกเกรด</a></li>
                <li class="nav-menu"><a href="/examprofessor">ข้อสอบ</a></li>
                <li class="dropdown nav-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                    รายงาน<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="sub-nav-menu"><a href="/ggrade">รายงานเกรด</a></li>
                        <li class="sub-nav-menu"><a href="#">รายงานข้อสอบ</a></li>
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