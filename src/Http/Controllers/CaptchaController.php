<?php

namespace Djimmy\Captcha\Http\Controllers;

use Djimmy\Captcha\Services\CaptchaService;
use Illuminate\Support\Facades\Session;

class CaptchaController extends Controller
{
    protected $captchaService;

    public function __construct(CaptchaService $captchaService)
    {
        $this->captchaService = $captchaService;
    }

    public function showCaptcha()
    {
        $image = $this->captchaService->generateCaptcha();
        $base64Image = base64_encode($image);
        return response()->json(['captcha' => $base64Image]);
    }

    public function validateCaptcha($input)
    {
        $captchaCode = Session::get('captcha_code');
        if ($captchaCode && strtolower($input) === strtolower($captchaCode)) {
            return response()->json(['valid' => true]);
        }
        return response()->json(['valid' => false], 400);
    }
}
