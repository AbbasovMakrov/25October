<?php

namespace App\Notifications;

use App\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\JsonResponse;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MessageSent extends Notification
{
    use Queueable;
    private $message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast'];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage($this->toArray($notifiable));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            "messageId" => $this->message->id,
            "from" => $this->message->user->name,
            "to" => $this->message->to_user_id,
            "sectionType" => $this->messageType()
        ];
    }
    private function messageType()
    {
        $type = "";
        if ($this->message->user_id != auth()->id())
            $type = "his";
        if ($this->message->file)
            $type .=  file_type($this->message->file);
        if ($this->message->message)
            $type .= "text";
        return $type;
    }
    public function broadcastOn()
    {
        return ['notifications-channel'];
    }
}
