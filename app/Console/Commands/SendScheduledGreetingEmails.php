<?php

namespace App\Console\Commands;

use App\Jobs\SendGreetingEmailJob;
use App\Mail\SendGreetingEmail;
use App\Models\EmailTemplate;
use App\Models\EmployeeDetail;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendScheduledGreetingEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-scheduled-greeting-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send scheduled greeting emails (Birthday, Anniversary, Retirement, Holiday) at 9:30 AM';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('Starting scheduled email job');
        
        $todayMonthDay = Carbon::now()->format('m-d');
        $todayFullDate = Carbon::now()->format('Y-m-d');

        $emailTemplates = EmailTemplate::where(function ($query) {
            $query->where('is_birthday', true)
                  ->orWhere('is_joining_aniversery', true)
                  ->orWhere('is_retirement', true)
                  ->orWhere('is_holiday', true);
        })->get();

        foreach ($emailTemplates as $emailTemplate) {
            if ($emailTemplate->is_birthday) {
                $query = EmployeeDetail::whereRaw("DATE_FORMAT(dob, '%m-%d') = ?", [$todayMonthDay]);
                Log::info("Total employees for birthday: " . $query->count());
                $this->processEmployees($emailTemplate, $query);
            }
            if ($emailTemplate->is_joining_aniversery) {
                $query = EmployeeDetail::whereRaw("DATE_FORMAT(doj, '%m-%d') = ?", [$todayMonthDay]);
                Log::info("Total employees for joining anniversary: " . $query->count());
                $this->processEmployees($emailTemplate, $query);
            }
            if ($emailTemplate->is_retirement) {
                $query = EmployeeDetail::whereRaw("DATE_FORMAT(dor, '%Y-%m-%d') = ?", [$todayFullDate]);
                Log::info("Total employees for retirement: " . $query->count());
                $this->processEmployees($emailTemplate, $query);
            }
            if ($emailTemplate->is_holiday && $emailTemplate->event_id) {
                $this->processHolidayEmails($emailTemplate, $todayFullDate);
            }            
        }
        Log::info("All greeting emails have been queued.");
        $this->info("Scheduled greeting emails have been queued successfully.");
    }

    private function processEmployees($emailTemplate, $query)
    {
        $query->chunk(1, function ($employees) use ($emailTemplate) {
            foreach ($employees as $employee) {
                $emails = array_filter([$employee->email_official, $employee->email_personal]);

                if (empty($emails)) {
                    Log::warning("Skipping employee {$employee->id}: No valid email.");
                    continue;
                }

                foreach ($emails as $email) {
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        Log::warning("Skipping invalid email: {$email}");
                        continue;
                    }
    
                    Log::info("Queuing email for: {$email}");
    
                    SendGreetingEmailJob::dispatch(
                        $email,
                        "{$employee->first_name} {$employee->last_name}",
                        "{$employee->title} {$employee->last_name}",
                        $emailTemplate->subject,
                        $emailTemplate->email_body,
                        $emailTemplate->signature
                    );
                }
                unset($employee);
                gc_collect_cycles();
            }
        });
        Log::info("Chunk execution completed.");
    }

    private function processHolidayEmails($emailTemplate, $todayFullDate)
    {
        $holiday = Event::where('id', $emailTemplate->event_id)
                        ->whereDate('date', $todayFullDate)
                        ->first();

        if ($holiday) {
            Log::info("Processing holiday emails for event: {$holiday->name}");

            $query = EmployeeDetail::query();
            Log::info("Total employees for holiday: " . $query->count());

            $this->processEmployees($emailTemplate, $query);
        } else {
            Log::warning("No holiday event found for today.");
        }
    }

    // private function sendEmails($employees, $emailTemplate) {
    //     foreach ($employees as $employee) {
    //         $emails = array_filter([$employee->email_official, $employee->email_personal]);

    //         foreach ($emails as $email) {
    //             if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //                 Mail::to($email, "{$employee->first_name} {$employee->last_name}")
    //                     ->send(new SendGreetingEmail(
    //                         $emailTemplate->subject,
    //                         "{$employee->title} {$employee->last_name}",
    //                         $emailTemplate->email_body,
    //                         $emailTemplate->signature
    //                     ));
    //             }
    //         }
    //     }
    // }

    // private function sendHolidayEmails($emailTemplate, $todayFullDate)
    // {
    //     $holiday = Event::where('id', $emailTemplate->event_id)
    //                     ->whereRaw("DATE_FORMAT(date, '%Y-%m-%d') = ?", [$todayFullDate])
    //                     ->first();

    //     if ($holiday) {
    //         $employees = EmployeeDetail::all(); // Send to all employees
    //         $this->sendEmails($employees, $emailTemplate);
    //     }
    // }
}
