<?php
Route::prefix('')->group(function () 
{
    Route::Get('/login','\App\Modules\Login\LoginController@index')->name('login');
    Route::Post('/login','\App\Modules\Login\LoginController@action');
    Route::Get('/logout','\App\Modules\Login\LoginController@logout');

    Route::group(['middleware'=>['auth']], function()
    {
      Route::Get('/','\App\Modules\Home\HomeController@index');
      Route::POST('/upload','\App\Modules\Home\UploadController@store');
      Route::POST('/upload-exam','\App\Modules\Home\UploadController@exam');
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
      Route::resource('/admin', '\App\Modules\Admin\AdminController');
      Route::Get('/enrostudent','\App\Modules\EnrolmentStudent\EnrolmentStudentController@index');
      Route::POST('/enrostudent','\App\Modules\EnrolmentStudent\EnrolmentStudentController@store');
      Route::resource('/grade','\App\Modules\Grade\GradeController');
      Route::Get('/examprofessor','\App\Modules\ExamProfessor\ExamProfessorController@index');
      Route::Get('/history','\App\Modules\History\HistoryController@index');
      Route::resource('/educate','\App\Modules\Educate\EducateController');
      Route::resource('/ggrade','\App\Modules\Ggrade\GgradeController');
      Route::resource('/sgrade','\App\Modules\Sgrade\SgradeController');
      Route::resource('/plan','\App\Modules\Plan\PlanController');
      Route::resource('/hisgrade','\App\Modules\HistoryGrade\HistoryGradeController');
      Route::resource('/dgrade','\App\Modules\Dgrade\DgradeController');
      Route::Get('/detail-report/{program_id}/{bran_id}', '\App\Modules\DetailProgram\DetailProgramController@report');
      Route::resource('/preprogram', '\App\Modules\PreProgram\PreProgramController');
      Route::Get('/editprogram/{group_id}', '\App\Modules\Program\ProgramController@showw');
      Route::Get('/editplan/{enro_id}', '\App\Modules\Plan\PlanController@editplan');
      Route::Get('/educate-report', '\App\Modules\Educate\EducateController@report');
      Route::Get('/print-program/{program_id}/{bran_id}', '\App\Modules\DetailProgram\DetailProgramController@print_program');
      Route::Get('/print-educate', '\App\Modules\Educate\EducateController@print_educate');
      Route::Get('/list-one', '\App\Modules\Enrolment\EnrolmentController@page_group');
      Route::resource('/year', '\App\Modules\Year\YearController');
      Route::resource('/detail', '\App\Modules\DetailProgram\DetailProgramController');
      Route::Get('/subject-group', '\App\Modules\DetailProgram\DetailProgramController@get_subjectBygroup');
      Route::Get('/educate-teach', '\App\Modules\Educate\EducateController@index2');

    });
});
?>