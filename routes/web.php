<?php

use App\Http\Controllers\MatchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [SkillController::class, 'dashboard'])->name('dashboard');

    Route::get('/skills/edit', [SkillController::class, 'edit'])->name('skills.edit');
    Route::post('/skills/update', [SkillController::class, 'update'])->name('skills.update');

    Route::get('/matches', [MatchController::class, 'index'])->name('matches.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';