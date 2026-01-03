<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;

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
    Schema::defaultStringLength(191);

    $this->loadMigrationsFrom([
        database_path('migrations/customer'),
        database_path('migrations/product'),
        database_path('migrations/order'),
   
    ]);
}

}
