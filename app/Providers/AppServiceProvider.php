<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\MailSetting;
use Config;

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
    public function boot()
    {
    }
}
