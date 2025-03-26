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
        $experiences_level = [
            ['name' => 'intern', 'image' => 'career_level/intern.webp'],
            ['name' => 'fresh', 'image' => 'career_level/fresh.webp'],
            ['name' => 'junior', 'image' => 'career_level/junior.webp'],
            ['name' => 'senior', 'image' => 'career_level/senior.webp'],
            ['name' => 'expert', 'image' => 'career_level/expert.webp'],
            ['name' => 'lead', 'image' => 'career_level/lead.webp'], 
            ['name' => 'manager', 'image' => 'career_level/manger.webp'],
        ]; 
        

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

        return view('candidates.home', compact('categories', 'popularCategories', 'locations', 'popularJobs', 'jobCandidates', 'topCompanies','experiences_level'));
    }
    
}
