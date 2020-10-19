<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use View;
use Sentinel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    { 
       


       
        
        Schema::defaultStringLength(191);
        View::composer('*', function($view){
            $user = Sentinel::findById(1);
            $view->with('user_role_all', $user );
            
        });
    }
}
