<?php

namespace App\Providers;

use App\Models\App;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

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

                $current_route = Route::currentRouteName();

                $APPS = App::select('id', 'codigo', 'nombre', 'id_app_padre', 'ruta', 'icono',
                                    DB::raw("CASE WHEN ruta = '$current_route' THEN 1 ELSE 0 END AS ruta_actual")
                                )
                                ->where('activo', 1)
                                ->where('visible', 1)
                                ->get();


                $view->with('USER_AUTENTICATED', $USER_AUTENTICATED);
                $view->with('APPS', $APPS);

            }
        );

        Paginator::useBootstrap();

    }
}
