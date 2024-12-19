<p align="center"><a href="https://github.com/djimmy-poliard/laravel-captcha" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/djimmy/captcha"><img src="https://img.shields.io/packagist/dt/djimmy/captcha" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/djimmy/captcha"><img src="https://img.shields.io/packagist/v/djimmy/captcha" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/djimmy/captcha"><img src="https://img.shields.io/packagist/l/djimmy/captcha" alt="License"></a>
</p>

## About Laravel Captcha

Laravel Captcha is a simple and customizable package to integrate CAPTCHA functionality into your Laravel application. It provides an easy-to-use API for generating CAPTCHA codes and validating user inputs, helping to protect your application from bots and spam.

## Features

- Generates customizable CAPTCHA images.
- Validates CAPTCHA inputs.
- Clears CAPTCHA sessions automatically.
- Easily integrates with Laravel applications.

## Installation

Install the package using Composer:

```bash
composer require djimmy/captcha
```

## Usage

1. **Add the Service Provider (if not auto-discovered):**

   ```php
   // config/app.php
   'providers' => [
       Djimmy\Captcha\CaptchaServiceProvider::class,
   ];
   ```

2. **Publish the Config File:**

   ```bash
   php artisan vendor:publish --provider="Djimmy\Captcha\CaptchaServiceProvider"
   ```

3. **Generate a CAPTCHA Image:**

   In your controller:

   ```php
   use Djimmy\Captcha\CaptchaService;

   public function showCaptcha(CaptchaService $captchaService)
   {
       return $captchaService->generateCaptcha();
   }
   ```

4. **Validate CAPTCHA:**

   ```php
   use Illuminate\Http\Request;
   use Djimmy\Captcha\CaptchaService;

   public function validateCaptcha(Request $request, CaptchaService $captchaService)
   {
       $isValid = $captchaService->validateCaptcha($request->input('captcha'));

       if ($isValid) {
           // CAPTCHA is valid
       } else {
           // CAPTCHA is invalid
       }
   }
   ```

5. **Clear CAPTCHA:**

   ```php
   $captchaService->clearCaptcha();
   ```

## Contributing

Contributions are welcome! Please feel free to submit a pull request or open an issue on GitHub.

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
