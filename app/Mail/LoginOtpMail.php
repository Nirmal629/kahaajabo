<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $otp;
    public $userName;

    public function __construct($email, $otp, $userName = 'User')
    {
        $this->email = $email;
        $this->otp = $otp;
        $this->userName = $userName;
    }

    public function build()
    {
        return $this->subject('Your Login OTP')
                    ->view('emails.login-otp');
    }
}