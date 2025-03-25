<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\User;
use App\Models\JobListing;
use App\Models\Location;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name', 'ASC')->get();

        
        $popularCategories = Category::withCount([
            'jobs' => function ($query) {
                $query->where('application_deadline', '>=', now())
                      ->where('status', 'approved');
            }
        ])->orderBy('name', 'ASC')->take(10)->get();
        $locations = Location::orderBy('name', 'ASC')->get(); 
        $popularJobs = JobListing::where('status', 'approved')->where('application_deadline', '>=', now())->get();
        $jobCandidates = User::where('role', 'candidate')->with('profile')->latest()->take(8)->get(); 
        $topCompanies = Company::withCount([
            'jobs' => function ($query) {
                $query->where('application_deadline', '>=', now())
                      ->where('status', 'approved');
            }
            ])->orderBy('name', 'ASC')->get();
            // dd($popularCategories);

        return view('candidates.home', compact('categories', 'popularCategories', 'locations', 'popularJobs', 'jobCandidates', 'topCompanies'));
    }
    
}
