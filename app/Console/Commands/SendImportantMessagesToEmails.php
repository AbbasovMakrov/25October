<?php

namespace App\Console\Commands;

use App\Mail\ImportantMessages;
use App\Message;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendImportantMessagesToEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'messages:to-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Messages To current Emails When Internet is Available';
    /**
     * @var array
     */
    private $emails = [
//        "h.cj994@gmail.com",
//        "ahm3d.ahm3d25879@gmail.com",
//        "yasirgino@gmail.com",
        "abbasaljoker@gmail.com"
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $req = new Client();
        try {
            $requestGoogle = $req->get("https://www.google.com");
            if ($requestGoogle->getStatusCode() == 200) {
                $messages = Message::whereIsImportant(true)->whereImportantMessageSentAt(null)->get();
                foreach ($messages as $message) {
                    $message->update([
                        "important_message_sent_at" => Carbon::now()->toDateTimeString()
                    ]);
                    Mail::to($this->emails)->send(new ImportantMessages($message));
                    $this->info("message with id:{$message->id} sent to important mails");
                }
            }
        }
        catch (\Exception $exception)
        {
            $this->warn($exception->getMessage());
        }
    }
}
