<?php

namespace App\Listeners;

use App\Events\SendVerificationCodeEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Mail\VerificationCodeMail;

class SendVerificationCodeListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendVerificationCodeEvent $event): void
    {
        $code = str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);

        Cache::put("verification_code_{$event->email}", $code, now()->addMinutes(10));

        Mail::to($event->email)->send(new VerificationCodeMail($code));
    }
}
