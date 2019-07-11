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
        $this->loadViewsFrom(__DIR__.'/Professor/Views','pro');

        $this->loadViewsFrom(__DIR__.'/Student/Views','student');
<<<<<<< HEAD

        $this->loadViewsFrom(__DIR__.'/Student/Views','student');
=======
>>>>>>> 501707778d4690b428c0a8c925fbc3b576667fff

        


    }
}