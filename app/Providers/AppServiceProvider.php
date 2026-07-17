<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (Schema::hasTable('settings')) {
            View::share(
                'appSetting',
                Setting::first()
            );
        } else {
            View::share('appSetting', null);
        }
    }
}