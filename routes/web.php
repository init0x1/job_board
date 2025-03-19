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
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ApplicationController;

// =============================
// ✅ Public Routes
// =============================
Route::get('/', [HomeController::class, 'index'])->name('candidates.home');


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
Route::middleware(['auth', 'role:candidate'])->group(function () {
    Route::get('/candidate/skills', [SkillsController::class, 'create'])->name('candidate.skills.create');

    // Store skills after form submission
    Route::post('/candidate/skills', [SkillsController::class, 'store'])->name('candidate.skills.store');
    

    Route::get('/candidate/dashboard', function () {
        return view('candidate.dashboard');
    })->name('candidate.dashboard');
});

// =============================
// ✅ Employer Routes
// =============================
Route::middleware(['auth', 'role:employer'])->group(function () {
    Route::get('/employer/company', [CompanyController::class, 'showCompanyForm'])->name('employer.company');
    Route::post('/employer/company', [CompanyController::class, 'storeCompany']);

    Route::get('/employer/dashboard', function () {
        return view('employer.dashboard');
    })->name('employer.dashboard');
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
    Route::get('/jobs/pending', [AdminDashboardController::class, 'pendingJobs'])->name('admin.jobs.pending');
    Route::post('/jobs/{job}/approve', [AdminDashboardController::class, 'approveJob'])->name('admin.jobs.approve');
    Route::post('/jobs/{job}/reject', [AdminDashboardController::class, 'rejectJob'])->name('admin.jobs.reject');

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
// =========================================================
// Cadidantes Home page appear for login and non login users
// =========================================================
// Route::resource('company',CompanyController::class);
// company index , show Routes

Route::get('/user/company/{id}', [CompanyController::class, 'show_user'])->name('user.company.show');
Route::get('/user/company', [CompanyController::class, 'index_user'])->name('user.company.index');
// Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');

// Candidate index , show Routes
Route::get('/user/candidate', [CandidateController::class, 'index_user'])->name('user.candidate.index');
Route::get('/user/candidate/{id}', [CandidateController::class, 'show_user'])->name('user.candidate.show');

// job index , show Routes
Route::get('/user/job', [JobListingController::class, 'index_user'])->name('user.job.index');
Route::get('/user/job/{id}', [JobListingController::class, 'show_user'])->name('user.job.show');

// category index , show Routes

Route::get('/user/category', [CategoryController::class, 'index_user'])->name('user.category.index');
// Route::get('/user/category/{id}', [CategoryController::class, 'show_user'])->name('user.category.show');

//application index , show Routes
// Route::get('/user/application', [ApplicationController::class, 'index_user'])->name('user.application.index');
// Route::get('/user/application/{id}', [ApplicationController::class, 'show_user'])->name('user.application.show');
// Route::get('/job/apply/{id}', [ApplicationController::class, 'applyJob'])->name('job.apply');

// Apply job Route
Route::post('/apply-job/{id}',[JobListingController::class,'applyJob'])->name('user.applyJob');
Route::post('/save-job/{id}',[JobListingController::class,'saveJob'])->name('user.saveJob');
require __DIR__.'/auth.php';
