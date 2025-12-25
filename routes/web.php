<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnjingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ShelterController;
use App\Http\Controllers\AdoptionRequestController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoriteController;

// Home Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');

// Auth Routes (simple form)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', function () {
    return view('auth.logout');
});

// Pet Routes
Route::get('/pets', [PetController::class, 'index'])->name('pets.index');
Route::get('/category/{slug}', [PetController::class, 'byCategory'])->name('pets.category');

Route::middleware(['auth', 'not-admin'])->group(function () {
    Route::get('/pets/create', [PetController::class, 'create'])->name('pets.create');
    Route::post('/pets', [PetController::class, 'store'])->name('pets.store');
    Route::get('/my-pets', [PetController::class, 'mine'])->name('pets.mine');
});

Route::get('/pets/{slug}', [PetController::class, 'show'])->name('pets.show');

// Shelter Routes
Route::get('/shelters', [ShelterController::class, 'index'])->name('shelters.index');
Route::get('/shelters/{id}', [ShelterController::class, 'show'])->name('shelters.show');
Route::get('/shelters/create', [ShelterController::class, 'create'])->name('shelters.create');
Route::post('/shelters', [ShelterController::class, 'store'])->name('shelters.store');

// Adoption Request Routes (requires authentication but NOT admin)
Route::middleware(['auth', 'not-admin'])->group(function () {
    Route::get('/my-adoptions', [AdoptionRequestController::class, 'index'])->name('adoptions.index');
    Route::get('/adopt/{pet}', [AdoptionRequestController::class, 'create'])->name('adoptions.create');
    Route::post('/adopt/{pet}', [AdoptionRequestController::class, 'store'])->name('adoptions.store');
    Route::get('/adoptions/{adoptionRequest}', [AdoptionRequestController::class, 'show'])->name('adoptions.show');
    Route::post('/adoptions/{adoptionRequest}/cancel', [AdoptionRequestController::class, 'cancel'])->name('adoptions.cancel');

    // Profile Routes (User only)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    // Favorite Routes
    Route::post('/favorites/{pet}/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.dashboard'));
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/pets', [AdminController::class, 'pets'])->name('pets');
    Route::get('/pets/{pet}/edit', [AdminController::class, 'editPet'])->name('pets.edit');
    Route::put('/pets/{pet}', [AdminController::class, 'updatePet'])->name('pets.update');
    Route::post('/pets/{pet}/image', [AdminController::class, 'updatePetImage'])->name('pets.image');
    Route::post('/pets/{pet}/status', [AdminController::class, 'updatePetStatus'])->name('pets.status');
    Route::get('/adoptions', [AdminController::class, 'adoptions'])->name('adoptions');
    Route::post('/adoptions/{adoptionRequest}/approve', [AdminController::class, 'approveAdoption'])->name('adoptions.approve');
    Route::post('/adoptions/{adoptionRequest}/reject', [AdminController::class, 'rejectAdoption'])->name('adoptions.reject');
});

// Cara Adopsi Route
Route::get('/cara-adopsi', function () {
    return view('adoption.guide');
})->name('adoption.guide');

Route::post('/anjing-old', [AnjingController::class, 'store']);

Route::get('/Filter_anjing', function () {
    return view('Filter_anjing');
});

Route::get('/Login', function () {
    return view('Login');
});

Route::get('/Register', function () {
    return view('Register');
});

Route::get('/Chat', function () {
    return view('Chat');
});

