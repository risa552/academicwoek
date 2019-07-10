@extends('Login-layout') 
@section('title','เข้าสู่ระบบ')
@section('content')
      <center> 

        <div class="modal-content" style="height:302px; width:352px; margin-top: 100px; ">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Log in</h4>
            </div> <!-- /.modal-header -->

                <div class="modal-body">
                    <form role="form">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" id="username" placeholder="Login">
                                <label for="uLogin" class="input-group-addon glyphicon glyphicon-user"></label>
                            </div>
                        </div> <!-- /.form-group -->

                        <div class="form-group">
                            <div class="input-group">
                                <input type="password" class="form-control" id="Password" placeholder="Password">
                                <label for="uPassword" class="input-group-addon glyphicon glyphicon-lock"></label>
                            </div> <!-- /.input-group -->
                        </div> <!-- /.form-group -->

                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember me
                            </label>
                        </div> <!-- /.checkbox -->
                    </form>

                </div> <!-- /.modal-body -->
                    <div class="modal-footer">
                        <button class="form-control btn btn-primary">Ok</button>
                        <div class="progress" style="height:0px; width:0px;">
                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="100" style="width: 0%;">
                                <span class="sr-only">progress</span>
                            </div>
                        </div>
                    </div> <!-- /.modal-footer -->

        </div>
@endsection
