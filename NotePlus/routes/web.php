<?php

use App\Mail\InviteMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\InvitationController;

// Route::get('/', function () {
//     return view('app.index');
// });

Route::controller(UserController::class)->group(function() {
    Route::get('/', 'index')->name('welcome');
    Route::get('/home', 'create')->middleware(['auth'])->name('user.index');
});

Route::controller(RegisterController::class)->group(function() {
    Route::get('/signup', 'create')->name('register.create');
    Route::post('/signup', 'store')->name('register.store');
});

Route::controller(LoginController::class)->group(function() {
    Route::get('/signin', 'index')->name('login.index');
    Route::post('/signin', 'login')->name('login.store');
    Route::post('/logout', 'logout')->middleware(['auth'])->name('logout');
});

Route::controller(NoteController::class)->middleware(['auth'])->group(function() {
    Route::get('/notes', 'index')->name('notes.index');
    // Route::get('/notes/create', 'create')->name('notes.create');
    Route::post('/notes', 'store')->name('notes.store');
    Route::get('/notes/{id}', 'show')->name('notes.show');
    Route::get('/notes/{id}/edit', 'edit')->name('notes.edit');
    Route::put('/notes/{id}', 'update')->name('notes.update');
    Route::delete('/notes/{id}', 'destroy')->name('notes.destroy');
});

Route::controller(TeamController::class)->middleware(['auth'])->group(function() {
    Route::get('/teams', 'index')->name('teams.index');
    Route::get('/teams/create', 'create')->name('teams.create');
    Route::post('/teams', 'store')->name('teams.store');
    Route::get('/teams/{id}', 'show')->name('teams.show');
    Route::get('/teams/{id}/edit', 'edit')->name('teams.edit');
    Route::put('/teams/{id}', 'update')->name('teams.update');
    Route::delete('/teams/{id}', 'destroy')->name('teams.destroy');
});

Route::controller(InvitationController::class)->group(function() {
    Route::post('/teams/{team}/invite',  'sendInvite')->name('invites.store');
    Route::get('/invite/accept/{token}/{team}', 'acceptInvite')->name('invites.accept');
});

// Route::get('/test-invite', function () {
//     $link = url('/invite/accept/testtoken');
//     Mail::to('uughasoro@gmail.com')->send(new InviteMail($link, $team = null));
//     return 'Invite test sent';
// });
