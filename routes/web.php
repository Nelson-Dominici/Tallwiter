<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Auth\Login;

use App\Livewire\Dashboard\Home;

use App\Livewire\Users\Create as UserCreate;


Route::prefix('users')->group(function() {

    Route::get('create', UserCreate::class)->name('users.create');

});

Route::prefix('auth')->group(function() {

    Route::get('login', Login::class)->name('auth.login');

});

Route::middleware('auth')->group(function() {

    Route::get('home/{filter}', Home::class)->name('home');

});
