<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ThankYouMail;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{
    // Function to send Thank You email to the logged-in user
    public function sendThankYouMail()
    {
        // Get the logged-in user using Auth facade
        $user = Auth::user(); // Use Auth::user() instead of Auth()->user()

        // Ensure the user is authenticated
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        // Send the email using a custom mailable class
        Mail::to($user->email)->send(new ThankYouMail($user));

        // Return success message
        return response()->json(['message' => 'Email sent successfully!']);
    }
}
