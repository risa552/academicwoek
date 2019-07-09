<?php
namespace App\Modules;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/Home/views','home');
        $this->loadViewsFrom(__DIR__.'/Login/Views','log');
<<<<<<< HEAD
        $this->loadViewsFrom(__DIR__.'/Program/Views','program');
=======
        $this->loadViewsFrom(__DIR__.'/Course/Views','cou');
        $this->loadViewsFrom(__DIR__.'/Test/Views','test');
>>>>>>> manubar
    }
}