<?php
  Route::Get('/','\App\Modules\Home\HomeController@index');
  Route::Get('/Login','\App\Modules\Login\LoginController@index');
?>