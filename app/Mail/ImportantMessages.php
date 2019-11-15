<?php

namespace App\Mail;

use App\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ImportantMessages extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Message
     */
    private $message;

    /**
     * Create a new message instance.
     *
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $markDown = $this->markdown('emails.important-messages-view',['msg' => $this->message])->from("iraq-protests@localserver.com","Iraq Protests");
        if ($this->message->file)
            return $markDown->attach(public_path("storage/{$this->message->file}"));
        return $markDown;
    }
}
