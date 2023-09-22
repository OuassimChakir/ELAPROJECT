<?php

namespace App\Providers;

use App\Models\Roles;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        
        Blade::if('admin', function(){
            $user = Auth::user();
            $role = Roles::getRole($user->idRole);
            return auth()->user() && $role->codeRole == '00';
        });
        Blade::if('notadmin', function(){
            $user = Auth::user();
            $role = Roles::getRole($user->idRole);
            return auth()->user() && $role->codeRole != '00';
        });

        Blade::if('staff', function(){
            $user = Auth::user();
            $role = Roles::getRole($user->idRole);
            return auth()->user() && ($role->codeRole == '00' || $role->codeRole == '11');
        });
        Blade::if('student', function(){
            $user = Auth::user();
            $role = Roles::getRole($user->idRole);
            return auth()->user() && ($role->codeRole == '00' || $role->codeRole == '11' || $role->codeRole == '22');
        });
        Blade::if('teacher', function(){
            $user = Auth::user();
            $role = Roles::getRole($user->idRole);
            return auth()->user() && ($role->codeRole == '00' || $role->codeRole == '11' || $role->codeRole == '33');
        });

        Blade::if('student_teacher', function(){
            $user = Auth::user();
            $role = Roles::getRole($user->idRole);
            return auth()->user() && ($role->codeRole == '33' || $role->codeRole == '22');
        });
        Paginator::useBootstrap();
    }
}
