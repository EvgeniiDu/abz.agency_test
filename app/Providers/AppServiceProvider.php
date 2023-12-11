<?php

namespace App\Providers;

use App\Classes\ImageUploader;
use App\Services\ResizeImage;
use App\Services\TinyPngService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ResizeImage::class, function (){
            return new TinyPngService(ResizeImage::class);
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
