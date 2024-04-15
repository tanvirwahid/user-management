<?php

namespace App\Http\Controllers\Auth\Traits;

use App\Notifications\TwoFactorNotification;

trait VerificationCodeSenderTrait
{
    public function sendVerificationCode()
    {
        $user = auth()->user();
        $user->generateTwoFactorCode();
        $user->notify(new TwoFactorNotification());

    }
}
