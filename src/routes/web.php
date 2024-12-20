<?php

use Illuminate\Support\Facades\Route;
use Djimmy\Captcha\Http\Controllers\CaptchaController;

Route::prefix('captcha')->group(function () {
    Route::get('show', [CaptchaController::class, 'showCaptcha']);
    Route::post('validate/{input}', [CaptchaController::class, 'validateCaptcha']);
});
