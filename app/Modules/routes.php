<?php
Route::prefix('')->group(function () {
  Route::Get('/','\App\Modules\Home\HomeController@index');
  Route::resource('/professor', '\App\Modules\Professor\ProfessorController');
  Route::Get('/login','\App\Modules\Login\LoginController@index');
  Route::Post('/login','\App\Modules\Login\LoginController@action');
<<<<<<< HEAD
  Route::resource('/studygroup', '\App\Modules\Studygroup\StudygroupController');
=======
  Route::resource('/group', '\App\Modules\Group\GroupController@index');
>>>>>>> c82004b522ff1d92a58330b3923051bb2e439c0d
  Route::resource('/course', '\App\Modules\Course\CourseController');

  /*Route::Get('/login','\App\Modules\Login\LoginController@index');
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
  Route::Get('/professor/editprof','\App\Modules\Professor\ProfessorController@editprof');
  Route::Get('/professor/fromprof','\App\Modules\Professor\ProfessorController@fromprof');
  Route::POST('/professor/fromprof','\App\Modules\Professor\ProfessorController@addaction');
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
  Route::Get('/logout','\App\Modules\Login\LoginController@logout');
  Route::Get('/admin','\App\Modules\Admin\AdminController@index');
  Route::Get('/admin/fromad','\App\Modules\Admin\AdminController@fromad');
  Route::Get('/admin/editad','\App\Modules\Admin\AdminController@editad');
  Route::Get('/degree','\App\Modules\Degree\DegreeController@index');
  Route::Get('/degree/fromde','\App\Modules\Degree\DegreeController@fromde');
  Route::Get('/degree/editde','\App\Modules\Degree\DegreeController@editde');
  Route::Get('/teach','\App\Modules\Teach\TeachController@index');
  Route::Get('/teach/fromte','\App\Modules\Teach\TeachController@fromte');
  Route::Get('/teach/editte','\App\Modules\Teach\TeachController@editte');
  Route::Get('/program/frompro','\App\Modules\Program\ProgramController@frompro');
  Route::Get('/program/editpro','\App\Modules\Program\ProgramController@editpro');
  Route::Get('/rights','\App\Modules\Rights\RightsController@index');
  Route::Get('/rights/fromrig','\App\Modules\Rights\RightsController@fromRig');
  Route::Get('/rights/editrig','\App\Modules\Rights\RightsController@editRig');*/
});
?>