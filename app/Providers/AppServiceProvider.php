<?php

namespace App\Providers;

use App\View\Composers\CommentsComposer;
use Illuminate\Support\Facades\View;
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
        // View Composer برای کامپوننت نظرات
        View::composer('front.components.commetns', CommentsComposer::class);
    }
}
