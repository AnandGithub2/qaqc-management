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
    try {
        View::share('appSetting', Setting::first());
    } catch (\Exception $e) {
        View::share('appSetting', null);
    }
}
}