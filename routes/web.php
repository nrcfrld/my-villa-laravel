<?php

use App\Http\Controllers\AmenitiesController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // Route::get('amenities', [AmenitiesController::class, 'index'])->name('amenities.index');
    // Route::get('amenities/create', [AmenitiesController::class, 'create'])->name('amenities.create');

    Route::livewire('amenities', 'pages::amenities.index')->name('amenities.index');
    Route::livewire('amenities/create', 'pages::amenities.create')->name('amenities.create');

    Route::get('amenities/{amenity}/edit', [AmenitiesController::class, 'edit'])->name('amenities.edit');
    Route::put('amenities/{amenity}', [AmenitiesController::class, 'update'])->name('amenities.update');


    // Villa routes
    Route::livewire('villas/create', 'pages::villas.create')->name('villas.create');
});

require __DIR__.'/settings.php';
