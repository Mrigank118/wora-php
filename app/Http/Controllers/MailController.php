<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ThankYouMail;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{
   
    public function sendThankYouMail()
    {
       
        $user = Auth::user(); 

       
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

      
        Mail::to($user->email)->send(new ThankYouMail($user));

       
        return response()->json(['message' => 'Email sent successfully!']);
    }
}
