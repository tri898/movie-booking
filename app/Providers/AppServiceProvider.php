<?php

namespace App\Providers;

use App\View\Components\Dropzone\Input;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Intervention\Image\Image;
use Plank\Mediable\Facades\ImageManipulator;
use Plank\Mediable\ImageManipulation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        ImageManipulator::defineVariant(
            'thumbnail',
            ImageManipulation::make(function (Image $image) {
                $image->fit(100);
            })->outputPngFormat()
        );
        Blade::component('dropzone-input', Input::class);
    }
}
