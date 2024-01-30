<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// add thư viện pagination vào
use Illuminate\Pagination\Paginator;

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
        // add pagiantion dùng cho boostrap 4
        Paginator::useBootstrapFour();
    }
}
