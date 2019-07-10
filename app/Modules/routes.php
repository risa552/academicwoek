<?php
  Route::Get('/','\App\Modules\Home\HomeController@index');
  Route::Get('/login','\App\Modules\Login\LoginController@index');
  Route::Get('/program','\App\Modules\Program\ProgramController@index');
  Route::Get('/course','\App\Modules\Course\CourseController@index');
  Route::Get('/exam','\App\Modules\Exam\ExamController@index');
  Route::Get('/exam/from','\App\Modules\Exam\ExamController@from');
  Route::Get('/subjectg','\App\Modules\Subjectg\SubjectgController@index');
  Route::Get('/subjectg/fromsubjectg','\App\Modules\Subjectg\SubjectgController@fromsubjectg');
  Route::Get('/exam/edit','\App\Modules\Exam\ExamController@edit');
  Route::Get('/subjectg/editsubjectg','\App\Modules\Subjectg\SubjectgController@editsubjectg');
  
  Route::Get('/group','\App\Modules\Group\GroupController@index');
  Route::Get('/group/fromgroup','\App\Modules\Group\GroupController@fromgroup');
  Route::Get('/group/editgroup','\App\Modules\Group\GroupController@editgroup');
  
?>