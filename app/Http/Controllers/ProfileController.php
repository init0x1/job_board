<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show user profile based on role.
     */
    public function show()
    {
        $user = Auth::user();

        if ($user->isEmployer()) {
            $company = Company::where('user_id', $user->id)->first();
            return view('profile.employer', compact('user', 'company'));
        }

        if ($user->isCandidate()) {
            return view('profile.candidate', compact('user'));
        }

        return view('profile.admin', compact('user'));
    }

    /**
     * Show edit form based on role.
     */
    public function edit()
    {
        $user = Auth::user();

        if ($user->isEmployer()) {
            $company = Company::where('user_id', $user->id)->first();
            return view('profile.edit-employer', compact('user', 'company'));
        }

        if ($user->isCandidate()) {
            return view('profile.edit-candidate', compact('user'));
        }

        return view('profile.edit-admin', compact('user'));
    }

    /**
     * Update user information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:8',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        if ($user->isEmployer()) {
            $request->validate([
                'company_name' => 'required|string|max:255',
                'industry' => 'required|string|max:255',
                'website' => 'nullable|url',
            ]);

            $company = Company::where('user_id', $user->id)->first();
            $company->update([
                'name' => $request->company_name,
                'industry' => $request->industry,
                'website' => $request->website,
            ]);
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }

    /**
     * Delete user account.
     */
    public function destroy()
    {
        $user = Auth::user();

        if ($user->isEmployer()) {
            Company::where('user_id', $user->id)->delete();
        }

        $user->delete();

        return redirect('/')->with('success', 'Account deleted successfully.');
    }
}
