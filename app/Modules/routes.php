<?php
  Route::Get('/','\App\Modules\Home\HomeController@index');
  Route::Get('/Login','\App\Modules\Login\LoginController@index');
<<<<<<< HEAD
  Route::Get('/program','\App\Modules\Program\ProgramController@index');
=======
  Route::Get('/Course','\App\Modules\Course\CourseController@index');
  Route::Get('/Test','\App\Modules\Test\TestController@index');
>>>>>>> manubar
?>