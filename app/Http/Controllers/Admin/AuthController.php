<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    /**
     * Show the admin registration form.
     */
    public function showRegistrationForm()
    {
        return view('admin.register');
    }

    /**
     * Handle admin registration.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'admin_code' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        if ($request->admin_code !== env('ADMIN_REGISTRATION_CODE', '123456')) {
            return back()->withErrors(['admin_code' => 'Invalid admin registration code.']);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('admin_images', 'public');
        }
        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'image' => $imagePath,
        ]);


        Auth::login($admin);

        return redirect()->route('admin.dashboard')->with('success', 'Admin registered successfully!');
    }

    /**
     * Show the admin login form.
     */
    public function showLoginForm()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Handle admin login.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            // Check if user is admin
            if ($user->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->route('dashboard')->with('success', 'Welcome Admin!');
            }

            // Logout if not admin
            Auth::logout();
            return back()->withErrors(['email' => 'Access denied. Only admins can log in.']);
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    /**
     * Handle admin logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }
}
