<?php
  Route::Get('/','\App\Modules\Home\HomeController@index');
  Route::Get('/login','\App\Modules\Login\LoginController@index');
  Route::Get('/program','\App\Modules\Program\ProgramController@index');
  Route::Get('/course','\App\Modules\Course\CourseController@index');
  Route::Get('/exam','\App\Modules\Exam\ExamController@index');
  Route::Get('/exam/from','\App\Modules\Exam\ExamController@from');

  Route::Get('/exam/edit','\App\Modules\Exam\ExamController@edit');
?>