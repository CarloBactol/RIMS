<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\UserLoggedIn;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogUserLogin  implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(UserLoggedIn $event)
    {
        // Update your table here
        $timestamp = now();
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, 'Asia/Manila'); // Use 'Asia/Manila' for Philippines timezone
        $date->setTimezone('UTC');
        User::where('id', $event->user->id)
            ->update(['last_login_at' => now()]);
    }
}
