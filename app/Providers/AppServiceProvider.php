<?php

namespace App\Providers;
use App\Services\Firestore;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\ReaderController;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Firestore::class, function ($app) {
            return new Firestore;
        });
    }



    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::listen(function($query) {
            var_dump($query->sql, $query->bindings);
        });
    }
}
