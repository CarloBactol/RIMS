<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Cache;

class LoginEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;

        // Implement your custom decay logic
        $decaySeconds = 10; // Adjust this value as needed

        if ($this->isLoginDecayed($user, $decaySeconds)) {
            auth()->logout(); // Log the user out for security reasons
            abort(429, 'Too many login attempts. Please wait before trying again.');
        }

        // Update the last login time
        $this->updateLastLoginTime($user);
    }

    private function isLoginDecayed($user, $decaySeconds)
    {
        $lastLoginTime = Cache::get('last_login_time_' . $user->id);

        return $lastLoginTime && now()->diffInSeconds($lastLoginTime) < $decaySeconds;
    }

    private function updateLastLoginTime($user)
    {
        Cache::put('last_login_time_' . $user->id, now());
    }
}
