<?php

namespace App\Console\Commands;

use App\Jobs\SendMails;
use App\Mail\SendEventMail;
use App\Models\Event;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $events = Event::findNexts()->get();

        foreach ($events as $event) {

            try {

                Mail::to($event->user_email)->send(new SendEventMail('Evento Próximo', 'date-soon-event', $event));

            } catch (\Exception $e) {
                Log::error('Error sending email: ' . $e->getMessage());
            }

        }

    }

}
