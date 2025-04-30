<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    $featuredUniversities = \App\Models\University::withCount('projects')
        ->orderBy('projects_count', 'desc')
        ->take(3)
        ->get();
    
    $recentProjects = \App\Models\Project::with(['university', 'user'])
        ->latest()
        ->take(5)
        ->get();

    return view('welcome', compact('featuredUniversities', 'recentProjects'));
});

Route::middleware('auth')->group(function () {
    // Projects
    Route::resource('projects', ProjectController::class)->except(['index', 'show']);
    

    //Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Comments
    Route::post('projects/{project}/comments', [CommentController::class, 'store'])
        ->name('comments.store');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])
        ->name('comments.destroy');
    
    // Likes
    Route::post('projects/{project}/likes/toggle', [LikeController::class, 'toggle'])
        ->name('likes.toggle');
    
    // Universities
    Route::post('universities', [UniversityController::class, 'store'])
        ->name('universities.store');
    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    

});


// Public routes
Route::resource('projects', ProjectController::class)->only(['index', 'show']);
Route::resource('universities', UniversityController::class)->only(['index', 'show']);


// Authentication routes (from Breeze)
require __DIR__.'/auth.php';