<?php

namespace App\Providers;

use App\Services\Book\SearchBook;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SearchBook::class, function () {
            $service = request('book_search_service_method', 'OpenLibrary');
            $service_class = "\App\Services\Book\\$service";
            throw_if(!class_exists($service_class), new \Exception("Service [$service] Not Implement"));
            return new $service_class;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
