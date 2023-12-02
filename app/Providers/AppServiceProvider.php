<?php

namespace App\Providers;

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
        view()->share(['gnl' => \App\Models\Setting::first()]);
        view()->share(['gnl_extra' => \App\Models\SettingExtra::first()]);
        view()->share(['socials' => \App\Models\Social::all()]);
    }
}
