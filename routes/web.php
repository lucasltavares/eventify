<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventFeedbackController;
use App\Http\Controllers\EventPhotoController;
use App\Http\Controllers\EventQuestionController;
use App\Http\Controllers\GuestSupportController;
use App\Http\Controllers\PublicEventPhotoCommentController;
use App\Http\Controllers\PublicEventPhotoUpvoteController;
use App\Http\Controllers\PublicEventController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', LogoutController::class)->name('logout');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('events', EventController::class);
    Route::get('events/{event}/copy-link', [EventController::class, 'copyLink'])->name('events.copy-link');
    Route::post('events/{event}/photos', [EventPhotoController::class, 'store'])->name('events.photos.store');
    Route::delete('events/{event}/photos/{photo}', [EventPhotoController::class, 'destroy'])->name('events.photos.destroy');
    Route::post('events/{event}/questions/{question}/reply', [EventQuestionController::class, 'reply'])->name('events.questions.reply');
});

Route::get('e/{event:slug}', [PublicEventController::class, 'show'])->name('events.public');
Route::post('e/{event:slug}/rsvp', [PublicEventController::class, 'rsvp'])->name('events.rsvp');
Route::post('e/{event:slug}/photos/{photo}/upvote', [PublicEventPhotoUpvoteController::class, 'store'])->name('events.photos.upvote');
Route::post('e/{event:slug}/photos/{photo}/comments', [PublicEventPhotoCommentController::class, 'store'])->name('events.photos.comments.store');
Route::get('support/{token}', [GuestSupportController::class, 'show'])->name('support.show');
Route::post('support/{token}', [GuestSupportController::class, 'store'])->name('support.store');
Route::get('feedback/{token}', [EventFeedbackController::class, 'show'])->name('feedback.show');
Route::post('feedback/{token}', [EventFeedbackController::class, 'store'])->name('feedback.store');
