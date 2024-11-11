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
            'level' => 'Admin' // Assuming all users are Admin, you can change this
        ]);

        // Redirect to login page after successful registration
        return redirect()->route('login');
    }

    // Login page
    public function login()
    {
        return view('auth.login');
    }

    // Handle login action
    public function loginAction(Request $request)
    {
        // Validate login credentials
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        // Attempt login
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed') // If login fails
            ]);
        }

        // Regenerate session after successful login
        $request->session()->regenerate();

        // Redirect to welcome page after successful login
        return redirect()->route('welcome');
    }

    // Logout user
    public function logout(Request $request)
    {
        // Log the user out
        Auth::guard('web')->logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Redirect to the welcome page after logout
        return redirect()->route('welcome');
    }


    // User profile page
    public function profile()
    {
        return view('profile');
    }
}
