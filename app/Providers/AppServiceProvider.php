<?php

namespace App\Providers;

use App\Models\App;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        //
        view()->composer(
            ['layouts.sidebar_new', 'layouts.navbar_new'],
            function ($view) {

                $USER_ID = Auth::user()->id;

                // echo "USER AUTENTICATED: " . $USER_ID;
                $USER_AUTENTICATED = User::where('id', $USER_ID)->first();

                $APPS = App::select('id', 'codigo', 'nombre', 'id_app_padre', 'ruta', 'icono')->where('activo', 1)->where('visible', 1)->get();
                $view->with('USER_AUTENTICATED', $USER_AUTENTICATED);
                $view->with('APPS', $APPS);

            }
        );

        Paginator::useBootstrap();

    }
}
