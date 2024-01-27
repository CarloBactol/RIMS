<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\UserLoggedOut;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogUserLogout implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserLoggedOut  $event
     * @return void
     */
    use InteractsWithQueue;

    public function handle(UserLoggedOut $event)
    {
        // Update your table here
        User::where('id', $event->user->id)
            ->update(['last_logout_at' => now()]);
    }
}
