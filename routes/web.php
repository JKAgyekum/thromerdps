<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/host', function () {
    return view('host');
})->middleware(['auth', 'verified'])->name('host');

Route::middleware('auth')->group(function () {
    Route::get('/tickets', [TicketController::class, 'edit'])->name('tickets.edit');
    Route::patch('/tickets', [TicketController::class, 'update'])->name('tickets.index');
    Route::delete('/tickets', [TicketController::class, 'create'])->name('tickets.create');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
