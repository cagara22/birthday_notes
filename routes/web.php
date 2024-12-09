<?php

use App\Http\Controllers\GreetingController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::controller(GreetingController::class)->group(function () {
    Route::get('greetings', 'index')->middleware(['auth', 'verified'])->name('greetings.index');
    Route::get('greetings/create', 'create')->middleware(['auth', 'verified'])->name('greetings.create');
    Volt::route('greetings/{greeting}/edit', 'greetings.edit')->middleware(['auth', 'verified'])->name('greetings.edit');
    Route::get('greetings/{greeting}', 'show')->name('greetings.show');
});

require __DIR__ . '/auth.php';
