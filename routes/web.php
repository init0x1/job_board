<?php

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

// =============================
// ✅ Public Routes
// =============================
Route::get('/', function () {
    return view('welcome');
})->name('home');

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
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Manage users
    Route::get('/admin/users/{role}', [AdminDashboardController::class, 'listUsers'])->name('admin.users.list');
    Route::get('/admin/users/edit/{id}', [AdminDashboardController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/update/{id}', [AdminDashboardController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/delete/{id}', [AdminDashboardController::class, 'deleteUser'])->name('admin.users.delete');
    // Manage Pending Job Listings
    Route::get('/admin/jobs/pending', [AdminDashboardController::class, 'pendingJobs'])->name('admin.jobs.pending');

    // Approve a Job Listing
    Route::post('/admin/jobs/{job}/approve', [AdminDashboardController::class, 'approveJob'])->name('admin.jobs.approve');

    // Reject a Job Listing
    Route::post('/admin/jobs/{job}/reject', [AdminDashboardController::class, 'rejectJob'])->name('admin.jobs.reject');

    // Manage Skills (Admin Only)
    Route::get('/admin/skills', [SkillsController::class, 'index'])->name('admin.skills');
    Route::post('/admin/skills', [SkillsController::class, 'store']);
    Route::delete('/admin/skills/{skill}', [SkillsController::class, 'destroy']);
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
