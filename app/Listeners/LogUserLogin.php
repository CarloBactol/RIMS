<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\UserLoggedIn;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogUserLogin  implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(UserLoggedIn $event)
    {
        // Update your table here
        User::where('id', $event->user->id)
            ->update(['last_login_at' => now()]);
    }
}
