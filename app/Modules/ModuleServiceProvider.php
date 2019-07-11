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
<<<<<<< HEAD
        $this->loadViewsFrom(__DIR__.'/Professor/Views','pro');
=======

>>>>>>> 30c631a318be3121c1ef21569599e47371cccfb4
        $this->loadViewsFrom(__DIR__.'/Student/Views','student');
        $this->loadViewsFrom(__DIR__.'/Teaching/Views','teaching');
        


    }
}