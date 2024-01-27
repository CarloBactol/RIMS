<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\UserLoggedIn;
use App\Events\UserLoggedOut;
use App\Listeners\LogUserLogin;
use App\Listeners\LogUserLogout;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\LoginEventListener',
        ],
        'App\Events\UserLoggedIn' => [
            'App\Listeners\LogUserLogin',
        ],
        'App\Events\UserLoggedOut' => [
            'App\Listeners\LogUserLogout',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
