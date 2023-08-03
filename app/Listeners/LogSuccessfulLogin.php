<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;

class LogSuccessfulLogin
{
    /**
     * Handle the event.
     *
     * @param \Illuminate\Auth\Events\Login $event
     * @return void
     */
    public function handle(Login $event)
    {
        $event->user->update([
            'last_login_at' => Carbon::now(),
            'last_login_ip' => request()->getClientIp()
        ]);
    }
}
