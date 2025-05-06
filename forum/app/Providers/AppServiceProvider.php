<?php

namespace App\Providers;

use App\Http\Middleware\V2\PersonalAccessToken;
use App\Traits\BuildMacroHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;
use URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

        // we force HTTPS for every environment but dev
        if (! app()->environment('dev') && ! app()->environment('local')) {
            URL::forceScheme('https');
        }

        // set LV locale so it is possible to sort by Latvian characters
        setlocale(LC_ALL, 'lv_LV');

        // Ensure correct publishing path for language files if needed
        $this->publishes([
            __DIR__ . '/../lang' => app()->langPath(),
        ], 'lang');

        Blade::if('permission', function ($permission) {
            return app('laratrust')->hasPermission($permission);
        });

        Builder::macro('search', function ($settings, $filter) {
            return (new BuildMacroHelper)->searchMacro($this, $settings, $filter);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Smart IDE assistance: https://github.com/barryvdh/laravel-ide-helper
        if ($this->app->isLocal() && class_exists(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class)) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
