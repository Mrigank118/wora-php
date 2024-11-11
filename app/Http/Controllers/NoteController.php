<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    // Method to display the saved notes view (it will be part of your main layout)
    public function viewNotes()
    {
        return view('note');  // This will load the notes.blade.php file
    }

    // Method to fetch saved notes via AJAX (to be called from the frontend)
    public function fetchNotes()
    {
        // Get the authenticated user's saved notes
        $notes = Note::where('user_id', Auth::id())->get();

        // Return the notes as JSON response
        return response()->json([
            'notes' => $notes
        ]);
    }
}
