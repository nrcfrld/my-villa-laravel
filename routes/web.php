<?php

use App\Http\Controllers\AmenitiesController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::get('amenities', [AmenitiesController::class, 'index'])->name('amenities.index');
    Route::get('amenities/create', [AmenitiesController::class, 'create'])->name('amenities.create');
    Route::post('amenities', [AmenitiesController::class, 'store'])->name('amenities.store');
    Route::delete('amenities/{amenity}', [AmenitiesController::class, 'destroy'])->name('amenities.destroy');
    Route::get('amenities/{amenity}/edit', [AmenitiesController::class, 'edit'])->name('amenities.edit');
    Route::put('amenities/{amenity}', [AmenitiesController::class, 'update'])->name('amenities.update');
});

require __DIR__.'/settings.php';
