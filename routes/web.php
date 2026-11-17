<?php

use App\Http\Controllers\BountyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/bounties', [BountyController::class, 'index'])->name('bounties.index');
    Route::get('/bounties/buat', [BountyController::class, 'create'])->name('bounties.create');
    Route::post('/bounties', [BountyController::class, 'store'])->name('bounties.store');
    Route::get('/bounties/{bounty}', [BountyController::class, 'show'])->name('bounties.show');
});

require __DIR__.'/auth.php';
