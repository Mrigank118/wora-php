<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
  
    public function viewNotes()
    {
        return view('note');  
    }

   
    public function fetchNotes()
    {
        
        $notes = Note::where('user_id', Auth::id())->get();

    
        return response()->json([
            'notes' => $notes
        ]);
    }
}
