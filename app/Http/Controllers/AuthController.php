<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register()
    {
        return view("auth.register");
    }

    public function store()
    {
        $validated = request()->validate([
            "name" => "required|min:3|max:40",
            "email" => "required|email|unique:users,email",
            "password" => "required|confirmed|min:8"
        ]);

        $user = User::create([
            "name" => $validated["name"],
            "email" => $validated["email"],
            "password" => $validated["password"]
        ]);

        Mail::to($user->email)->send(new WelcomeEmail($user));

        return redirect()->route('dashboard')->with("success", "Account created successfully!");
    }

    public function login()
    {
        return view("auth.login");
    }

    public function authenticate()
    {
        try {
            $validated = request()->validate([
                "email" => "required|email",
                "password" => "required|min:8"
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        }

        //Auth::attempt
        if (auth()->attempt($validated)) {
            request()->session()->regenerate();
            return redirect()->route('dashboard')->with("success", "Logged in successfully!");
            // return response()->json([
            //     'message' => 'Logged in successfully!',
            //     'user' => auth()->user(),
            // ], 200);
        }

        return redirect()->route('dashboard')->withErrors([
            'email' => 'No matching user found with the provided email and password!'
        ]);
        // return response()->json([
        //     'error' => 'Invalid email or password!'
        // ], 401);
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('dashboard')->with('success', 'Logged out successfully!');
    }
}
