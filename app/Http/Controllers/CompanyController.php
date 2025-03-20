<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Show the company information form for employers.
     */
    public function index_user()
    {
        
        $companies = Company::all();
        return view('globalPages.companies.index', compact('companies'));
    }

    /**
    * Display the specified resource.
    */

   public function show_user($id)
    {
        $company =  Company::find($id); // Fetch job by ID
        
        if (!$company) {
            return redirect()->route('user.company.index')->with('error', 'Company not found');
        }
        return view('globalPages.companies.show', compact('company'));
    }
    public function showCompanyForm()
    {
        return view('employer.company', [
            'company' => Auth::user()->company,
        ]);
    }

    /**
     * Store or update company information.
     */
    public function storeCompany(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'website' => 'nullable|url',
            'description' => 'nullable|string',
            'industry' => 'nullable|string|max:255',
            'established_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // 2MB Max
            'brands_images.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to add a company.');
        }
        
        // Handle logo upload
        $logoPath = $user->company->logo_path ?? null;
        if ($request->hasFile('logo')) {
            if ($logoPath) {
                Storage::delete('public/' . $logoPath);
            }
            $logoPath = $request->file('logo')->store('company_logos', 'public');
}
        // handle multiple brand_images
        $brandImages = [];
        if ($request->hasFile('brands_images')) {
            foreach ($request->file('brands_images') as $image) {
                $brandImages[] = $image->store('company_brands', 'public');
            }
        }

        // Update or create company record
        $company = Company::firstOrNew(['user_id' => $user->id]);
        $company->name = $request->name;
        $company->website = $request->website;
        $company->description = $request->description;
        $company->industry = $request->industry;
        $company->established_year = $request->established_year;
        $company->logo_path = $logoPath;
        $company->brands_images = json_encode($brandImages);
        $company->save();
        
        
        return redirect()->route('employer.dashboard')->with('success', 'Company information saved successfully.');
    }

    /**
     * Show company profile.
     */
    public function show($id)
    {
        $company = Company::findOrFail($id);
        return view('company.show', compact('company'));
    }
}
