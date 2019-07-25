<?php
Route::prefix('')->group(function () 
{
    Route::Get('/login','\App\Modules\Login\LoginController@index')->name('login');
    Route::Post('/login','\App\Modules\Login\LoginController@action');
    Route::Get('/logout','\App\Modules\Login\LoginController@logout');

    Route::group(['middleware'=>['auth']], function()
    {
      Route::Get('/','\App\Modules\Home\HomeController@index');
      Route::resource('/professor', '\App\Modules\Professor\ProfessorController');
      Route::resource('/studygroup', '\App\Modules\Studygroup\StudygroupController');
      Route::resource('/course', '\App\Modules\Course\CourseController');
      Route::resource('/degree', '\App\Modules\Degree\DegreeController');
      Route::resource('/term', '\App\Modules\Term\TermController');
      Route::resource('/subject', '\App\Modules\Subject\SubjectController');
      Route::resource('/program', '\App\Modules\Program\ProgramController');
      Route::resource('/educate', '\App\Modules\Educate\EducateController');
      Route::resource('/subjectgroup', '\App\Modules\Subjectgroup\SubjectgroupController');
      Route::resource('/exam', '\App\Modules\Exam\ExamController');
      Route::resource('/enrolment', '\App\Modules\Enrolment\EnrolmentController');
      Route::resource('/branch', '\App\Modules\Branch\BranchController');
      Route::resource('/student', '\App\Modules\Student\StudentController');
    });
});
?>