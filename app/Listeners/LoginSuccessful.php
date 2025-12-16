<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoginSuccessful
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
     * @param  IlluminateAuthEventsLogin  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $event->subject="login";
        $event->description="Login Successful";
        activity($event->subject)
            ->performedOn($event->user)
            ->causedBy($event->user)
            ->log($event->description);
    }
}
