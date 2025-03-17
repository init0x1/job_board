<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], // Max 2MB
        ]);

        // Handle Image Upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('user_images', 'public');
        }

        // Create User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $imagePath,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('choose.role');
    }

    /**
     * Show the role selection page.
     */
    public function showRoleSelection(): View
    {
        return view('auth.choose-role');
    }

    /**
     * Handle role selection after registration.
     */
    public function selectRole(Request $request): RedirectResponse
    {
        $request->validate([
            'role' => ['required', 'in:employer,candidate'],
        ]);

        $user = Auth::user();
        $user->update(['role' => $request->role]);

        // Redirect based on role
        if ($user->role == 'candidate') {
            return redirect()->route('candidate.skills');
        } else {
            return redirect()->route('employer.company');
        }
    }
}
