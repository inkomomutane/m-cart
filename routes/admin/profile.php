<?php

use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\ProfileController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/{user}/logo/upload', [ProfileController::class, 'logoUpload'])->name('profile.logo.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
