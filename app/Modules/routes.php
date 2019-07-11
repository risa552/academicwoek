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
  Route::Get('/sub','\App\Modules\Sub\SubController@index');
  Route::Get('/sub/fromsub','\App\Modules\Sub\SubController@fromsub');
  Route::Get('/professor','\App\Modules\Professor\ProfessorController@index');
  Route::Get('/professor/proedit','\App\Modules\Professor\ProfessorController@proedit');
  Route::Get('/professor/proform','\App\Modules\Professor\ProfessorController@proform');
  Route::Get('/sub/editsub','\App\Modules\Sub\SubController@editsub');
<<<<<<< HEAD
=======
  


>>>>>>> 501707778d4690b428c0a8c925fbc3b576667fff
  Route::Get('/student','\App\Modules\Student\StudentController@index');
  Route::Get('/student/fromstu','\App\Modules\Student\StudentController@fromstu');
  Route::Get('/student/editstu','\App\Modules\Student\StudentController@editstu');
?>