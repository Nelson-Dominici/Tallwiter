<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Users\Create as UserCreate;

use App\Livewire\Home\{
    Profile as HomeProfile,
    Dashboard as HomeDashboard
};

use App\Livewire\Auth\Login;

Route::prefix('users')->group(function() {

    Route::get('create', UserCreate::class)->name('users.create');

});

Route::prefix('auth')->group(function() {

    Route::get('login', Login::class)->name('auth.login');

});

Route::prefix('home')->middleware('auth')->group(function() {

    Route::get('/profile', HomeProfile::class)->name('home.profile');
    Route::get('/dashboard', HomeDashboard::class)->name('home.dashboard');

});
