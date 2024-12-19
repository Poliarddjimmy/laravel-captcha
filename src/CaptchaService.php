<?php

namespace Djimmy\Captcha;

use Illuminate\Support\Facades\Session;

class CaptchaService
{
    public function generateCaptcha()
    {
        $code = $this->generateCode(); // Generate random code
        Session::put('captcha_code', $code); // Store in session

        $width = 140;
        $height = 40;

        // Create an image resource
        $image = imagecreatetruecolor($width, $height);

        // Define colors
        $backgroundColor = imagecolorallocate($image, 240, 240, 240);
        $textColor = imagecolorallocate($image, 0, 0, 0);
        $lineColor = imagecolorallocate($image, 100, 100, 100);

        // Fill background
        imagefill($image, 0, 0, $backgroundColor);

        // Add random lines for noise
        for ($i = 0; $i < 5; $i++) {
            imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $lineColor);
        }

        // Add the text (captcha code)
        imagettftext($image, 20, 0, 30, 30, $textColor, public_path('assets/fonts/Arial.ttf'), $code);

        // Set content-type header for PNG image
        header('Content-Type: image/png');
        
        // Output the image
        imagepng($image);

        // Free up memory
        imagedestroy($image);
    }
    
    public function validateCaptcha($userInput)
    {
        $code = Session::get('captcha_code'); // Get the captcha code from session
        return $code === $userInput; // Check if the code matches
    }
    
    public function clearCaptcha()
    {
        Session::forget('captcha_code'); // Clear the captcha code from session
    }

    private function generateCode($length = 5)
    {
        return substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, $length);
    }
}
