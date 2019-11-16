<?php

namespace App\Listeners;

use App\Events\MessageSentToUser;
use App\Notifications\MessageSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MessageSentListener
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
     * @param  MessageSentToUser  $event
     * @return void
     */
    public function handle(MessageSentToUser $event)
    {
        $event->message->user_to->notify(new MessageSent($event->message));
    }
}
