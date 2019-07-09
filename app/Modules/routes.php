<?php
  Route::Get('/','\App\Modules\Home\HomeController@index');
  Route::Get('/Login','\App\Modules\Login\LoginController@index');
  Route::Get('/program','\App\Modules\Program\ProgramController@index');
?>