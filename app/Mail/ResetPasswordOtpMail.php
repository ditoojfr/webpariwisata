<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    // 1. Variabel ini WAJIB public biar bisa dibaca di file .blade.php
    public $otp;

    // 2. Tangkap kode OTP dari AuthController
    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    // 3. Atur Subjek Email
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kode OTP Reset Password - Nganjuk Abirupa',
        );
    }

    // 4. Arahkan ke file tampilan (view) email
    public function content(): Content
    {
        return new Content(
            view: 'emails.reset_password', // <-- Pastikan ini mengarah ke view yang bener
        );
    }

    public function attachments(): array
    {
        return [];
    }
}