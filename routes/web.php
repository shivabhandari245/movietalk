<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MyListController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\DashboardController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');

// Movies Routes

// Authentication Routes
Route::prefix('user')->group(function () {
    // Login Routes
    Route::get('/login', [UserController::class, 'loginForm'])->name('user.login.form');
    Route::post('user/login', [UserController::class, 'login'])->name('user.login');
    
    // Registration Routes
    Route::get('/register', [UserController::class, 'registerForm'])->name('user.register.form');
    Route::post('/register', [UserController::class, 'register'])->name('user.register');
    
    // Password Reset Routes
    Route::get('/forgot-password', [UserController::class, 'showForgotPasswordForm'])->name('user.forgot-password.form');
    Route::post('/forgot-password', [UserController::class, 'sendResetLinkEmail'])->name('user.forgot-password.email');
    Route::get('/reset-password/{token}', [UserController::class, 'showResetPasswordForm'])->name('user.password.reset');
    Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('user.password.update');
    
});


Route::get('user/movie/{movieId}', [MovieController::class, 'show'])->name('movie.detail');
// Protected Routes (Require Authentication)
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('user/movies', [MovieController::class, 'index'])->name('movies');

Route::post('user/movie/{movieId}/review', [MovieController::class, 'submitReview'])->name('movie.submit-review');
Route::post('user/movie/{movieId}/rate', [MovieController::class, 'submitRating'])->name('movie.submit-rating');

    // Profile Routes
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [UserController::class, 'updatePassword'])->name('profile.password.update');
    
    // Watchlist Routes


    // Movie Watchlist Actions
    Route::post('/movie/{movieId}/watchlist', [MovieController::class, 'toggleWatchlist'])->name('movie.toggle-watchlist');
    
    // Logout
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});






Route::prefix('admin')->as('admin.')->group(function () {
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/movies', [MovieController::class, 'moviesdata']);
Route::post('/addmovies', [MovieController::class, 'insertmovies']);
Route::get('/addmovies', [MovieController::class, 'addshow']);

});


Route::get('/movies/search', [MovieController::class, 'search'])->name('movies.search');
Route::middleware(['auth'])->group(function () {
    Route::get('/mylist', [MyListController::class, 'index'])->name('mylist');
    Route::post('/mylist/add', [MyListController::class, 'store'])->name('mylist.add');
    Route::delete('/mylist/remove/{id}', [MyListController::class, 'destroy'])->name('mylist.remove');
    Route::post('/mylist/toggle-watched/{id}', [MyListController::class, 'toggleWatched'])->name('mylist.toggle-watched');
    Route::post('/mylist/update-progress/{id}', [MyListController::class, 'updateProgress'])->name('mylist.update-progress');
});