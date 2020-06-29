<?php

namespace App\Listeners;

use App\Events\UserWasCreated;
use App\Mail\loginCredentials;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendLoginCredentials
{

    /**
     * Handle the event.
     *
     * @param  UserWasCreated  $event
     * @return void
     */
    public function handle(UserWasCreated $event)
    {
        Mail::to($event->user)->queue( new loginCredentials($event->user, $event->password));
    }
}
