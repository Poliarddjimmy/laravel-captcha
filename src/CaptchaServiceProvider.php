<?php

namespace Djimmy\Captcha;

use Illuminate\Support\ServiceProvider;
use Djimmy\Captcha\Services\CaptchaService;

class CaptchaServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(CaptchaService::class, function ($app) {
            return new CaptchaService();
        });
    }

    public function boot()
    {
        // Load package routes
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        // Publish assets
        $this->publishes([
            __DIR__ . '/../assets/fonts' => $this->getPublicPath('assets/fonts'),
        ], 'captcha-assets');
        
        // Publish controller
        $this->publishes([
            __DIR__ . '/Controllers/CaptchaController.php' => app_path('Http/Controllers/CaptchaController.php'),
        ], 'captcha-controller');

        // Publish routes
        $this->publishes([
            __DIR__ . '/routes/web.php' => base_path('routes/captcha.php'),
        ], 'captcha-routes');
    }

    private function getPublicPath(string $path = '')
    {
        if (function_exists('public_path')) {
            return public_path($path);
        }

        return base_path('public/' . $path);
    }
}
