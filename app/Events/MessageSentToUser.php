<?php

namespace App\Events;

use App\Http\Resources\MessageResource;
use App\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSentToUser implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var MessageResource $message
     */
    public $message;
    /**
     * Create a new event instance.
     *
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->message = new MessageResource($message);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {

        return new PrivateChannel('messages-channel');
    }
    public function broadcastAs()
    {
        return 'newMessage';
    }
}
