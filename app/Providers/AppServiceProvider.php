<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;

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
        // Share plugins array with all views
        View::share('plugins', []);

        // Custom Blade directive for including JavaScript files with a query string
        Blade::directive('jsScript', function ($str) {
            $path = asset($str . "?q=" . time());
            return '<script src="' . $path . '"></script>';
        });

        // Force HTTPS if in specific environments
        if (in_array(env('APP_ENV'), ['production', 'ministry', 'egov'])) {
            URL::forceScheme('https');
        }
    }
}
