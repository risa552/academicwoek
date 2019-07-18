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
        $this->loadViewsFrom(__DIR__.'/Course/Views','cou');
        $this->loadViewsFrom(__DIR__.'/Exam/Views','exam');
        $this->loadViewsFrom(__DIR__.'/Subjectg/Views','subjectg');
        $this->loadViewsFrom(__DIR__.'/Group/Views','group');
        $this->loadViewsFrom(__DIR__.'/Sub/Views','sub');
        $this->loadViewsFrom(__DIR__.'/Professor/Views','professor');
        $this->loadViewsFrom(__DIR__.'/Student/Views','student');
        $this->loadViewsFrom(__DIR__.'/Teaching/Views','teaching');
        $this->loadViewsFrom(__DIR__.'/Cou/Views','cou');
        $this->loadViewsFrom(__DIR__.'/Term/Views','term'); 
        $this->loadViewsFrom(__DIR__.'/Branch/Views','branch'); 
        $this->loadViewsFrom(__DIR__.'/Admin/Views','admin'); 
        $this->loadViewsFrom(__DIR__.'/Degree/Views','degree'); 
        $this->loadViewsFrom(__DIR__.'/Teach/Views','teach');
    }
}