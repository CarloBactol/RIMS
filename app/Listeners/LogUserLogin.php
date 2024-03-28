<?php

namespace App\Listeners;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Activity;
use App\Events\UserLoggedIn;
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
        echo $date;
    //    $data =  User::where('id', $event->user->id)
    //         ->update(['last_login_at' => now()]);
        $data = Activity::create(['name' => $event->user->name, 'type' =>'Login', 'date_logs' => now()]);
        return $data;
    }
}
