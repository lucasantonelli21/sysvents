<?php

namespace App\Jobs;

use App\Mail\SendMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SendEmailJob implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    public $email;
    public $subject;
    public $type;
    public $filePath;

    /**
     * Create a new job instance.
     */
    public function __construct($email, $subject, $type, $filePath = null)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->type = $type;
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Mail::to($this->email)->send(new SendMail($this->subject, $this->type, $this->filePath));

        if ($this->filePath && file_exists($this->filePath)) {
            unlink($this->filePath);
        }
    }
}
