<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderEmail;
use App\Models\User;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email every Minute';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Logic to send the email
        $user = User::first(); // Example: Send to the first user
        Mail::to($user->email)->send(new ReminderEmail ($user)); // Send the email
        
        $this->info('Email sent successfully!');
    }
}