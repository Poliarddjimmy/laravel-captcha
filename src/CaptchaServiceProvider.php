<?php

namespace Djimmy\Captcha;

use Illuminate\Support\ServiceProvider;

class CaptchaServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(CaptchaService::class, function () {
            return new CaptchaService();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../assets/fonts' => public_path('assets/fonts'),
        ], 'captcha-assets');
    }
}
