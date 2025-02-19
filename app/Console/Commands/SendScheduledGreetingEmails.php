<?php

namespace App\Console\Commands;

use App\Mail\SendGreetingEmail;
use App\Models\EmailTemplate;
use App\Models\EmployeeDetail;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Console\Command;
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
                $employees = EmployeeDetail::whereRaw("DATE_FORMAT(dob, '%m-%d') = ?", [$todayMonthDay])->get();
                $this->sendEmails($employees, $emailTemplate);
            }
            if ($emailTemplate->is_joining_aniversery) {
                $employees = EmployeeDetail::whereRaw("DATE_FORMAT(doj, '%m-%d') = ?", [$todayMonthDay])->get();
                $this->sendEmails($employees, $emailTemplate);
            }
            if ($emailTemplate->is_retirement) {
                $employees = EmployeeDetail::whereRaw("DATE_FORMAT(dor, '%Y-%m-%d') = ?", [$todayFullDate])->get();
                $this->sendEmails($employees, $emailTemplate);
            }
            if ($emailTemplate->is_holiday && $emailTemplate->event_id) {
                $this->sendHolidayEmails($emailTemplate, $todayFullDate);
            }
        }
        $this->info("Scheduled greeting emails sent successfully.");
    }

    private function sendEmails($employees, $emailTemplate) {
        foreach ($employees as $employee) {
            $emails = array_filter([$employee->email_official, $employee->email_personal]);

            if (!empty($emails)) {
                Mail::to($emails)->send(new SendGreetingEmail(
                    $emailTemplate->subject,
                    $emailTemplate->email_body,
                    $emailTemplate->signature
                ));
            }
        }
    }

    private function sendHolidayEmails($emailTemplate, $todayFullDate)
    {
        $holiday = Event::where('id', $emailTemplate->event_id)
                        ->whereRaw("DATE_FORMAT(date, '%Y-%m-%d') = ?", [$todayFullDate])
                        ->first();

        if ($holiday) {
            $employees = EmployeeDetail::all(); // Send to all employees
            $this->sendEmails($employees, $emailTemplate);
        }
    }
}
