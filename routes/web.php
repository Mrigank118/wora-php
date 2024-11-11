<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\ContentAdaptationController;
use App\Http\Controllers\NoteController;

// Default route for the welcome page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Authentication routes
Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
    Route::post('logout', 'logout')->middleware('auth')->name('logout');
});

// Chatbot interaction route
Route::post('/chatbot', [ChatbotController::class, 'getResponse']);

// Content adaptation route (single route for all platforms)
Route::post('/adapt-content', [ContentAdaptationController::class, 'adaptContent'])->name('adaptcontent');

// Notes routes
Route::post('/save-notes', [ChatbotController::class, 'saveNotes'])->middleware('auth');
Route::middleware(['auth'])->get('/notes', [NoteController::class, 'viewNotes'])->name('notes');
Route::middleware(['auth'])->get('/api/notes', [NoteController::class, 'fetchNotes']);
