<?php
  Route::Get('/','\App\Modules\Home\HomeController@index');
  Route::Get('/login','\App\Modules\Login\LoginController@index');
  Route::Get('/program','\App\Modules\Program\ProgramController@index');
  Route::Get('/course','\App\Modules\Course\CourseController@index');
  Route::Get('/exam','\App\Modules\Exam\ExamController@index');
  Route::Get('/exam/from','\App\Modules\Exam\ExamController@from');
<<<<<<< HEAD
  Route::Get('/subjectg','\App\Modules\Subjectg\SubjectgController@index');
  Route::Get('/subjectg/table','\App\Modules\Subjectg\SubjectgController@from');
=======

>>>>>>> faa973d7193cf20b1b92b8285b278801078008d5
  Route::Get('/exam/edit','\App\Modules\Exam\ExamController@edit');
?>