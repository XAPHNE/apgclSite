<?php

namespace App\Jobs;

use App\Mail\SendGreetingEmail;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendGreetingEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email, $employeeName, $subject, $body, $signature;

    /**
     * Create a new job instance.
     */
    public function __construct($email, $employeeName, $subject, $body, $signature)
    {
        $this->email = $email;
        $this->employeeName = $employeeName;
        $this->subject = $subject;
        $this->body = $body;
        $this->signature = $signature;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->email)->send(new SendGreetingEmail(
                $this->subject,
                $this->employeeName,
                $this->body,
                $this->signature
            ));
        } catch (Exception $e) {
            Log::error("Failed to send email to {$this->email}: " . $e->getMessage());
        }
    }
}
