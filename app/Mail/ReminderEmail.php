<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;

class ReminderEmail extends Mailable
{
    use SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     *
     * @param  User  $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->html('<h1>Hello ' . $this->user->name . ',</h1><p>This is your hourly reminder email!</p>');
    }
}