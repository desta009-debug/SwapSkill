<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SkillSwapController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');

    Route::get('/skills/edit', [SkillController::class, 'edit'])->name('skills.edit');
    Route::post('/skills/update', [SkillController::class, 'update'])->name('skills.update');

    Route::get('/matches', [MatchController::class, 'index'])->name('matches.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post(
        '/swap/request',
        [SkillSwapController::class, 'store']
    )->name('swap.store');
    Route::get(
        '/swaps',
        [SkillSwapController::class, 'index']
    )->name('swaps.index');
    Route::post(
        '/swaps/{skillSwap}/accept',
        [SkillSwapController::class, 'accept']
    )->name('swaps.accept');

    Route::post(
        '/swaps/{skillSwap}/reject',
        [SkillSwapController::class, 'reject']
    )->name('swaps.reject');
    Route::post(
        '/swaps/{skillSwap}/complete',
        [SkillSwapController::class, 'complete']
    )->name('swaps.complete');
    Route::post(
        '/ratings',
        [RatingController::class, 'store']
    )->name('ratings.store');
    Route::get(
        '/swaps/history',
        [SkillSwapController::class, 'history']
    )->name('swaps.history');

    Route::get('/messages', [\App\Http\Controllers\ChatController::class, 'index'])->name('messages.index');
    Route::get('/messages/{skillSwap}', [\App\Http\Controllers\ChatController::class, 'show'])->name('messages.show');
    Route::post('/messages/{skillSwap}', [\App\Http\Controllers\ChatController::class, 'store'])->name('messages.store');
    Route::get('/messages/{skillSwap}/fetch', [\App\Http\Controllers\ChatController::class, 'fetch'])->name('messages.fetch');
    // Public Profile
    Route::get('/user/{user}', [App\Http\Controllers\PublicProfileController::class, 'show'])->name('user.show');

    // Talent Showcase (Portfolio)
    Route::resource('portfolio', App\Http\Controllers\PortfolioController::class);

    // Certifications
    Route::post('/certifications', [App\Http\Controllers\CertificationController::class, 'store'])->name('certifications.store');
    Route::delete('/certifications/{certification}', [App\Http\Controllers\CertificationController::class, 'destroy'])->name('certifications.destroy');

});

require __DIR__ . '/auth.php';
