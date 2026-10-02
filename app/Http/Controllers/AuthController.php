<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Register form dikhane ke liye
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Register form submit handle karna
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:parent',
            'invite_code' => 'required|string',
        ]);

        $student = \App\Models\Student::where('invite_code', $request->invite_code)
            ->whereNull('invite_code_used_at')
            ->first();

        if (!$student) {
            return back()->withErrors([
                'invite_code' => 'Invalid or already used invite code.',
            ])->onlyInput('name', 'email');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => 'approved',
        ]);

        $student->update([
            'parent_id' => $user->id,
            'invite_code_used_at' => now(),
        ]);

        return redirect('/login')->with('success', 'Registration successful! You are now linked to your child\'s account. Please login.');
    }
    // Login form dikhane ke liye
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Login form submit handle karna
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Role ke hisab se dashboard pe redirect
            $role = Auth::user()->role;
            return redirect()->intended("/{$role}/dashboard");
        }

        return back()->withErrors([
            'email' => 'Email or Password is wrong',
        ])->onlyInput('email');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
