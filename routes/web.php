<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Livewire\Products;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    /* Productos */

    Volt::route('products', 'products.index')->name('products.index');
    Volt::route('products/create', 'products.create')->name('products.create');

    Volt::route('files', 'files.index')->name('files.index');
    Volt::route('files/create', 'files.create')->name('files.create');
});

require __DIR__.'/auth.php';
