<!doctype html>
<html class="no-js" lang="">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">   
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>เข้าสู่ระบบ</title>
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
                    <a class="navbar-brand" style="width:400px;">
                        <img class="mylogo" src="/assets/img/logo/logowed2.png"/>
                    </a>
                </div>
            </div>
        </nav>  
        <div class="container-fluid">
            <div class="modal-content" style="height:302px; width:352px; margin:100px auto;  ">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Log.in</h4>
                </div> <!-- /.modal-header -->
                <div class="modal-body">
                    <form role="form" id='login' >
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="username" placeholder="Login">
                                <label for="uLogin" class="input-group-addon glyphicon glyphicon-user"></label>
                            </div>
                        </div> <!-- /.form-group -->
                        <div class="form-group">
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <label for="Password" class="input-group-addon glyphicon glyphicon-lock"></label>
                            </div> <!-- /.input-group -->
                        </div> <!-- /.form-group -->
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> Remember me
                            </label>
                        </div> <!-- /.checkbox -->
                    </form>
                </div> <!-- /.modal-body -->
                        <div class="modal-footer">
                                <button class="form-control btn btn-primary" id="btn_login" type="button">Ok</button>
                            <div class="progress" style="height:0px; width:0px;">
                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="100" style="width: 0%;">
                                    <span class="sr-only">progress</span>
                                </div>
                            </div>
                        </div> <!-- /.modal-footer -->
            </div>
        </div>
        
            <script src="/assets/js/vendor/jquery-1.12.4.min.js"></script>
            <script src="/assets/js/bootstrap.min.js"></script>
            <script src="/assets/js/mysscipt.js"></script>
            <script>

                $(document).ready(function(){
                    $('#btn_login').on('click',function(e){
                    e.preventDefault();
                    var params = $('#login').serialize();
                    Helper.ajax('/login','POST',params,function(reponse){
                        window.location.href="/";
                    })
                });
                })
            </script>
    </body>
</html>