<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Register page
    public function register()
    {
        return view('auth.register');
    }

    // Handle registration form submission
    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ])->validate();

        // Create new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'Admin' 
        ]);

       
        return redirect()->route('login');
    }

    // Login page
    public function login()
    {
        return view('auth.login');
    }

   
    public function loginAction(Request $request)
    {
        
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed') // If login fails
            ]);
        }

      
        $request->session()->regenerate();

       
        return redirect()->route('welcome');
    }

    
    public function logout(Request $request)
    {
        
        Auth::guard('web')->logout();

       
        $request->session()->invalidate();

        
        return redirect()->route('welcome');
    }


   
    public function profile()
    {
        return view('profile');
    }
}
