<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;
use App\Models\Reviewer;
use App\Observers\ReviewerObserver;
use App\Models\Document;
use App\Observers\DocumentObserver;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(User::class, function ($app) {
            return Auth::user();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    
    }
}
