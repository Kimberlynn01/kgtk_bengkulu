<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
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

        // Macro for Query Builder
        QueryBuilder::macro('toSqlWithBindings', function () {
            $sql = $this->toSql();
            $bindings = $this->getBindings();

            foreach ($bindings as $binding) {
                $value = is_numeric($binding) ? $binding : (is_null($binding) ? 'NULL' : "'" . addslashes($binding) . "'");
                $sql = preg_replace('/\?/', $value, $sql, 1);
            }

            return $sql;
        });

        // Macro for Eloquent Builder
        EloquentBuilder::macro('toSqlWithBindings', function () {
            return $this->getQuery()->toSqlWithBindings();
        });
    }
}
