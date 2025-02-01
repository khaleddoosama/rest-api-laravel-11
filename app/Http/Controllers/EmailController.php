<?php

namespace App\Http\Controllers;

use App\Mail\ReminderEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    /**
     * Send a reminder email to a specific user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendReminderEmail(Request $request)
    {
        // Retrieve the user by the provided user_id
        $user = User::find($request->user_id);

        // Check if the user exists
        if ($user) {
            // Send the reminder email
            Mail::to($user->email)->send(new ReminderEmail($user));

            // Return a success response
            return response()->json(['message' => 'Email sent successfully'], 200);
        } else {
            // Return an error if the user was not found
            return response()->json(['message' => 'User not found'], 404);
        }
    }
}