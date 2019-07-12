<?php
  Route::Get('/','\App\Modules\Home\HomeController@index');
  Route::Get('/login','\App\Modules\Login\LoginController@index');
  Route::Post('/login','\App\Modules\Login\LoginController@action');
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
  Route::Get('/student','\App\Modules\Student\StudentController@index');
  Route::Get('/student/fromstu','\App\Modules\Student\StudentController@fromstu');
  Route::Get('/student/editstu','\App\Modules\Student\StudentController@editstu');
  Route::Get('/teaching','\App\Modules\Teaching\TeachingController@index');
  Route::Get('/teaching/fromtea','\App\Modules\Teaching\TeachingController@fromtea');
  Route::Get('/teaching/edittea','\App\Modules\Teaching\TeachingController@edittea');
  Route::Get('/teaching','\App\Modules\Teaching\TeachingController@index');
  Route::Get('/teaching/fromtea','\App\Modules\Teaching\TeachingController@fromtea');
  Route::Get('/teaching/edittea','\App\Modules\Teaching\TeachingController@edittea');
  Route::Get('/cou','\App\Modules\Cou\CouController@index');
  Route::Get('/cou/fromcou','\App\Modules\Cou\CouController@fromcou');
  Route::Get('/cou/editcou','\App\Modules\Cou\CouController@editcou');
  Route::Get('/term','\App\Modules\Term\TermController@index');
  Route::Get('/term/fromterm','\App\Modules\Term\TermController@fromterm');
  Route::Get('/term/editterm','\App\Modules\Term\TermController@editterm');
  Route::Get('/branch','\App\Modules\Branch\BranchController@index');
  Route::Get('/branch/frombranch','\App\Modules\Branch\BranchController@frombranch');
  Route::Get('/branch/editbranch','\App\Modules\Branch\BranchController@editbranch');
  Route::Get('/admin','\App\Modules\Admin\AdminController@index');
  Route::Get('/admin/fromad','\App\Modules\Admin\AdminController@fromad');
  Route::Get('/admin/editad','\App\Modules\Admin\AdminController@editad');

?>