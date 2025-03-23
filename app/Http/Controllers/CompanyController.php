<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{



    public function employerHome()
{
    $user = Auth::user();

    // Fetch recent jobs posted by the employer's company
    $jobs = $user->company ? $user->company->jobs()->latest()->take(5)->get() : collect();

    return view('employer.home', compact('jobs'));
}
    /**
     * Show all companies to users.
     */

    public function index_user()
    {
        $companies = Company::all();
        return view('globalPages.companies.index', compact('companies'));
    }

    /**
     * Display a specific company for users.
     */
    public function show_user($id)
    {
        $company = Company::find($id);
        
        if (!$company) {
            return redirect()->route('user.company.index')->with('error', 'Company not found');
        }

        return view('globalPages.companies.show', compact('company'));
    }

    /**
     * Show the company information form for employers.
     */
    public function showCompanyForm()
    {
        $user = Auth::user();
        return view('employer.company', [
            'company' => $user->company ?? new Company(),
            'profile' => $user->profile ?? new Profile(),
        ]);
    }

    /**
     * Store or update company and profile information.
     */
    public function storeCompany(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'website'          => 'nullable|url',
            'description'      => 'nullable|string|max:1000',
            'industry'         => 'nullable|string|max:255',
            'established_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'logo'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'brands_images.*'  => 'image|mimes:jpg,jpeg,png|max:2048',
            'job_title'        => 'required|string|max:255',
            'phone_number'     => 'required|string|max:15',
            'bio'              => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to add a company.');
        }

        // Save or update the company
        $company = Company::firstOrNew(['user_id' => $user->id]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            if ($company->logo_path) {
                Storage::delete('public/' . $company->logo_path);
            }
            $company->logo_path = $request->file('logo')->store('company_logos', 'public');
        }

        // Handle multiple brand images
        $brandImages = $company->brands_images ? json_decode($company->brands_images, true) : [];
        if ($request->hasFile('brands_images')) {
            foreach ($request->file('brands_images') as $image) {
                $brandImages[] = $image->store('company_brands', 'public');
            }
        }

        // Assign company attributes
        $company->name             = $request->name;
        $company->website          = $request->website;
        $company->description      = $request->description;
        $company->industry         = $request->industry;
        $company->established_year = $request->established_year;
        $company->brands_images    = json_encode($brandImages);
        $company->save();

        // Save or update the profile
        Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'job_title'    => $request->job_title,
                'phone_number' => $request->phone_number,
                'bio'          => $request->bio,
            ]
        );

        return redirect()->route('employer.dashboard')->with('success', 'Company and profile information saved successfully.');
    }

    /**
     * Show the employer's profile (name, email, image, company, and profile information).
     */
    public function employerProfile()
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile();
        $company = $user->company ?? new Company();

        return view('employer.profile', compact('user', 'profile', 'company'));
    }

    /**
     * Update the employer's profile (name, email, image, company, and profile information).
     */
    public function updateEmployerProfile(Request $request)
    {
        $request->validate([
            // User fields
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            // Profile fields
            'job_title'    => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'bio'          => 'nullable|string|max:1000',

            // Company fields
            'company_name'      => 'required|string|max:255',
            'website'           => 'nullable|url',
            'description'       => 'nullable|string|max:1000',
            'industry'          => 'nullable|string|max:255',
            'established_year'  => 'nullable|integer|min:1900|max:' . date('Y'),
            'logo'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        // Update user fields
        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::delete('public/' . $user->image);
            }
            $user->image = $request->file('image')->store('user_images', 'public');
        }
        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        // Update profile
        Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'job_title'    => $request->job_title,
                'phone_number' => $request->phone_number,
                'bio'          => $request->bio,
            ]
        );

        // Update company
        $company = Company::firstOrNew(['user_id' => $user->id]);

        if ($request->hasFile('logo')) {
            if ($company->logo_path) {
                Storage::delete('public/' . $company->logo_path);
            }
            $company->logo_path = $request->file('logo')->store('company_logos', 'public');
        }

        $company->name             = $request->company_name;
        $company->website          = $request->website;
        $company->description      = $request->description;
        $company->industry         = $request->industry;
        $company->established_year = $request->established_year;
        $company->save();

        return redirect()->route('employer.profile')->with('success', 'Profile updated successfully.');
    }

    /**
     * Show a company's profile.
     */
    public function show($id)
    {
        $company = Company::findOrFail($id);
        return view('company.show', compact('company'));
    }


    public function updateImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $user = Auth::user();
    
        // Delete old image if it exists
        if ($user->image && Storage::exists('public/' . $user->image)) {
            Storage::delete('public/' . $user->image);
        }
    
        // Store new image in `storage/app/public/user_images`
        $imagePath = $request->file('image')->store('user_images', 'public');
    
        // Update user image path in DB
        $user->update(['image' => $imagePath]);
    
        return redirect()->back()->with('success', 'Profile picture updated successfully.');
    }
}
