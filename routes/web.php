<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\JobListingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CandidateProfileController;

// =============================
// ✅ Public Routes appear for login and non login users
// =============================
// Home page
Route::get('/', [HomeController::class, 'index'])->name('candidates.home');
// company index , show Routes
Route::get('/user/company/{id}', [CompanyController::class, 'show_user'])->name('user.company.show');
Route::get('/user/company', [CompanyController::class, 'index_user'])->name('user.company.index');
// Candidate index , show Routes
Route::get('/user/candidate', [CandidateController::class, 'index_user'])->name('user.candidate.index');
Route::get('/user/candidate/{id}', [CandidateController::class, 'show_user'])->name('user.candidate.show');
// job index , show Routes
Route::get('/user/job', [JobListingController::class, 'index_user'])->name('user.job.index');
Route::get('/user/job/{id}', [JobListingController::class, 'show_user'])->name('user.job.show');
// category index , show Routes
Route::get('/user/category', [CategoryController::class, 'index_user'])->name('user.category.index');

// =============================
// ✅ User Authentication Routes
// =============================

// Registration (Employers & Candidates)
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Login & Logout (Employers & Candidates)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Role Selection After Registration
Route::middleware('auth')->group(function () {
    Route::get('/choose-role', [RegisteredUserController::class, 'showRoleSelection'])->name('choose.role');
    Route::post('/select-role', [RegisteredUserController::class, 'selectRole'])->name('select.role');
});

// =============================
// ✅ Universal Dashboard Route (Redirects Users Based on Role)
// =============================
Route::get('/dashboard', function () {
    if (Auth::check()) {
        return match (Auth::user()->role) {
            'candidate' => redirect()->route('candidate.dashboard'),
            'employer' => redirect()->route('employer.dashboard'),
            'admin' => redirect()->route('admin.dashboard'),
            default => redirect('/login'),
        };
    }
    return redirect('/login'); // If not logged in, redirect to login
})->name('dashboard');

// =============================
// ✅ Candidate Routes
// =============================
Route::prefix('candidate')->middleware(['auth', 'role:candidate'])->group(function () {
    Route::get('/candidate/skills', [SkillsController::class, 'create'])->name('candidate.skills.create');

    // Store skills after form submission
    Route::post('/skills', [SkillsController::class, 'store'])->name('candidate.skills.store');
    Route::get('/skills', [CandidateProfileController::class, 'showSkills'])->name('candidate.skills');
    Route::get('/profile', [CandidateProfileController::class, 'edit'])->name('candidate.profile.edit');
    Route::post('/profile', [CandidateProfileController::class, 'update'])->name('candidate.profile.update');
    Route::get('/profile', [CandidateProfileController::class, 'show'])->name('candidate.profile');
    Route::put('/profile/update', [CandidateProfileController::class, 'update'])->name('candidate.profile.update');
    Route::post('/profile/update-image', [CandidateProfileController::class, 'updateImage'])->name('candidate.profile.updateImage');


    Route::get('/dashboard', function () {
        return view('candidate.dashboard');
    })->name('candidate.dashboard');

    //application of candidtes index , show Routes, edit, create or apply , delete
    Route::get('/application', [ApplicationController::class, 'showUserApplications'])->name('candidate.application.index');
    Route::get('/application/{id}', [ApplicationController::class,  'showSingleUserApplication'])->name('candidate.application.show');
    Route::get('/application/create/{job_id}', [ApplicationController::class, 'create'])->name('candidate.createApplication');
    Route::post('/application/create/{job_id}', [ApplicationController::class, 'store'])->name('candidate.storeApplication');
    Route::get('/application/edit/{id}', [ApplicationController::class, 'edit'])->name('candidate.application.edit');
    Route::put('/application/{id}', [ApplicationController::class, 'update'])->name('candidate.application.update');
    Route::delete('/application/{id}', [ApplicationController::class, 'destroy'])->name('candidate.application.destroy');
});

// =============================
// ✅ Employer Routes
// =============================
Route::middleware(['auth', 'role:employer'])->group(function () {
    Route::get('/employer/company', [CompanyController::class, 'showCompanyForm'])->name('employer.company');
    Route::post('/employer/company', [CompanyController::class, 'storeCompany']);
    Route::get('/jobs/create', [JobListingController::class, 'create'])->name('employer.jobs.create');
    Route::post('/jobs', [JobListingController::class, 'store'])->name('employer.jobs.store');
    Route::get('/employer/dashboard', [JobListingController::class, 'employerDashboard'])->name('employer.dashboard');
    Route::get('/employer/jobs', [JobListingController::class, 'companyJobs'])->name('employer.jobs');
    Route::get('/employer/jobs/{job}', [JobListingController::class, 'showEmployerJob'])->name('employer.jobs.show');
    Route::get('/employer/jobs/{job}/edit', [JobListingController::class, 'edit'])->name('employer.jobs.edit');
    Route::put('/employer/jobs/{job}', [JobListingController::class, 'update'])->name('employer.jobs.update');
    Route::delete('/employer/jobs/{job}', [JobListingController::class, 'destroy'])->name('employer.jobs.destroy');
});

// =============================
// ✅ Admin Authentication Routes
// =============================

// Admin Login & Logout

Route::get('admin/register', [AuthController::class, 'showRegistrationForm'])->name('admin.register.form');
Route::post('admin/register', [AuthController::class, 'register'])->name('admin.register');
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Dashboard (Only for Admins)
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Manage users
    Route::get('/users/{role}', [AdminDashboardController::class, 'listUsers'])->name('admin.users.list');
    Route::get('/users/edit/{id}', [AdminDashboardController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/update/{id}', [AdminDashboardController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/delete/{id}', [AdminDashboardController::class, 'deleteUser'])->name('admin.users.delete');

    // Manage Pending Job Listings
    Route::get('/jobs/{status}',[AdminDashboardController::class, 'listJobs'])->name('admin.jobs.list');
    Route::get('/jobs/edit/{id}', [AdminDashboardController::class, 'editJob'])->name('admin.jobs.edit');
    Route::get('/jobs/pending', [AdminDashboardController::class, 'pendingJobs'])->name('admin.jobs.pending');
    Route::post('/jobs/{job}/approve', [AdminDashboardController::class, 'approveJob'])->name('admin.jobs.approve');
    Route::post('/jobs/{job}/reject', [AdminDashboardController::class, 'rejectJob'])->name('admin.jobs.reject');
    Route::delete('/jobs/delete/{id}', [AdminDashboardController::class, 'deleteJob'])->name('admin.jobs.delete');

    // Manage Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.list');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.delete');

    // Manage Skills
    Route::get('/skills', [SkillsController::class, 'index'])->name('admin.skills');
    Route::post('/skills', [SkillsController::class, 'store']);
    Route::delete('/skills/{skill}', [SkillsController::class, 'destroy']);
});
// =============================
// ✅ Profile Management (For All Users)
// =============================
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});



require __DIR__.'/auth.php';
