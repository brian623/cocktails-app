<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Cocktail;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public const HOME = '/cocktails';   
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
        View::composer('*', function ($view) {
        $view->with('savedCount', Cocktail::count());
    });
    }
}
