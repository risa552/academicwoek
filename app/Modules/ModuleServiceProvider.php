<?php
namespace App\Modules;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/Home/views','home');
        $this->loadViewsFrom(__DIR__.'/Login/Views','log');
        $this->loadViewsFrom(__DIR__.'/Program/Views','program');
        $this->loadViewsFrom(__DIR__.'/Course/Views','course');
        $this->loadViewsFrom(__DIR__.'/Exam/Views','exam');
        $this->loadViewsFrom(__DIR__.'/Subjectgroup/Views','subjectgroup');
        $this->loadViewsFrom(__DIR__.'/Studygroup/Views','studygroup');
        $this->loadViewsFrom(__DIR__.'/Subject/Views','subject');
        $this->loadViewsFrom(__DIR__.'/Professor/Views','professor');
        $this->loadViewsFrom(__DIR__.'/Student/Views','student');
        $this->loadViewsFrom(__DIR__.'/Term/Views','term'); 
        $this->loadViewsFrom(__DIR__.'/Branch/Views','branch'); 
        $this->loadViewsFrom(__DIR__.'/Admin/Views','admin'); 
        $this->loadViewsFrom(__DIR__.'/Degree/Views','degree'); 
        $this->loadViewsFrom(__DIR__.'/Educate/Views','educate'); 
        $this->loadViewsFrom(__DIR__.'/Enrolment/Views','enrolment'); 
        $this->loadViewsFrom(__DIR__.'/EnrolmentStudent/Views','enrostudent');
        $this->loadViewsFrom(__DIR__.'/Grade/Views','grade');
        $this->loadViewsFrom(__DIR__.'/ExamProfessor/Views','examprofessor');
        $this->loadViewsFrom(__DIR__.'/History/Views','history');
        $this->loadViewsFrom(__DIR__.'/Ggrade/Views','ggrade');
        $this->loadViewsFrom(__DIR__.'/Sgrade/Views','sgrade');
        $this->loadViewsFrom(__DIR__.'/Plan/Views','plan');
        $this->loadViewsFrom(__DIR__.'/HistoryGrade/Views','hisgrade');
        $this->loadViewsFrom(__DIR__.'/Dgrade/Views','dgrade');
        $this->loadViewsFrom(__DIR__.'/PreProgram/Views','preprogram');
        $this->loadViewsFrom(__DIR__.'/HomeStudent/Views','homestudent');
        $this->loadViewsFrom(__DIR__.'/DetailProgram/Views','detail');
        $this->loadViewsFrom(__DIR__.'/Year/Views','year');
    }
}