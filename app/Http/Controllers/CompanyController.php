<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of all companies.
     */
    public function index()
    {
        $companies = Company::all();
        return view('globalPages.companies.index', compact('companies'));
    }

    /**
     * Show the company creation form (Employer Only).
     */
    public function create()
    {
        return view('employer.company-form');
    }

    /**
     * Store or update a company profile (Employer Only).
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'established_year' => 'required|integer|min:1800|max:' . date('Y'),
            'website' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required|string|max:1000',
        ]);

        // Handle logo upload
        $logoPath = $request->hasFile('logo')
            ? $request->file('logo')->store('company_logos', 'public')
            : null;

        // Store or update company details for authenticated employer
        $company = Company::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'name' => $request->name,
                'industry' => $request->industry,
                'established_year' => $request->established_year,
                'website' => $request->website,
                'logo_path' => $logoPath,
                'description' => $request->description,
            ]
        );

        return redirect()->route('dashboard')->with('success', 'Company profile created successfully!');
    }

    /**
     * Display details of a specific company.
     */
    public function show($id)
    {
        $company = Company::findOrFail($id);
        return view('globalPages.companies.show', compact('company'));
    }

    /**
     * Show the form for editing a company (Employer Only).
     */
    public function edit(Company $company)
    {
        if (Auth::id() !== $company->user_id) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        return view('employer.company-form', compact('company'));
    }

    /**
     * Update the company details (Employer Only).
     */
    public function update(Request $request, Company $company)
    {
        if (Auth::id() !== $company->user_id) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'established_year' => 'required|integer|min:1800|max:' . date('Y'),
            'website' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required|string|max:1000',
        ]);

        if ($request->hasFile('logo')) {
            $company->logo_path = $request->file('logo')->store('company_logos', 'public');
        }

        $company->update($request->only(['name', 'industry', 'established_year', 'website', 'description']));

        return redirect()->route('dashboard')->with('success', 'Company profile updated successfully!');
    }

    /**
     * Remove the specified company (Employer Only).
     */
    public function destroy(Company $company)
    {
        if (Auth::id() !== $company->user_id) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        $company->delete();
        return redirect()->route('dashboard')->with('success', 'Company profile deleted successfully!');
    }
}
