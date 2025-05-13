<?php

namespace App\Providers;

use App\Services\SmsService;
use App\Interfaces\SmsInterface;
use Illuminate\Support\ServiceProvider;
use App\Models\Configuration\InfoEntreprise;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SmsInterface::class, SmsService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('rapports.pdf-header', function ($view) {
            $view->with('infoEntreprise', InfoEntreprise::latest()->first());
        });
    }
}
