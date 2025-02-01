<?php

use App\Console\Commands\SendEmail;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


// Schedule the email command to run every hour
Schedule::command(SendEmail::class)->everyMinute();