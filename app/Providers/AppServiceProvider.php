<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Upload file
         */
        $this->app->bind('Uploader', function() {
            return new \Nht\Hocs\Core\Uploads\Uploader(new \Nht\Hocs\Core\Uploads\Upload());
        });

        /**
         * Upload ảnh, có resize, crop
         */
        $this->app->bind('ImageUploader', function() {
            $uploader = $this->app->make('Uploader');
            $image = new \Nht\Hocs\Core\Images\Image();
            return new \Nht\Hocs\Core\Images\ImageFactory($uploader, $image);
        });


        // Sms
        $this->app->bind('App\Hocs\Sms\SmsInterface', 'App\Hocs\Sms\SmsService');
    }
}
