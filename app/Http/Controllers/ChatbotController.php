<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gemini\Laravel\Facades\Gemini;  // Import the Gemini facade
use App\Models\Note; // Import the Note model
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ChatbotController extends Controller
{
    // Method to handle response generation
    public function getResponse(Request $request)
    {
        $userInput = $request->input('message');
        try {
            $result = Gemini::geminiPro()->generateContent($userInput);
            $botResponse = $result->text(); // Assuming `text()` is still a valid method
            return response()->json(['message' => $botResponse]);
        } catch (\Exception $e) {
            Log::error('Gemini API error: ' . $e->getMessage());  // Log the error for debugging
            return response()->json(['error' => 'Failed to get response from Gemini API'], 500);
        }
    }

    public function saveNotes(Request $request)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
    
        // Get the current authenticated user
        $user = Auth::user();
    
        // Get the message to save
        $message = $request->input('message');
        
        // Create a new note for the user
        $note = new Note();
        $note->user_id = $user->id; // Assuming there's a `user_id` column in the notes table
        $note->content = $message;  // Store the content of the note
        $note->save();
    
        return response()->json(['success' => 'Note saved successfully']);
    }
    

}
