<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

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
         // Verifica si hay un idioma en la sesión
         if (Session::has('locale')) {
             $locale = Session::get('locale');
     
             // 🔥 FORZAR Laravel a aplicar el idioma
             App::setLocale($locale);
             config(['app.locale' => $locale]);
     
             // Registrar en logs para depuración
             logger('Idioma en sesión: ' . Session::get('locale'));
             logger('Idioma en App::getLocale(): ' . App::getLocale());
         } else {
             // Si no hay un idioma en la sesión, establecer el predeterminado
             Session::put('locale', config('app.locale'));
         }
     }


}
