<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Auth\Login;

use App\Livewire\Post\Index;

use App\Livewire\User\Profile;
use App\Livewire\User\Create as UserCreate;

Route::prefix('users')->group(function() {

    Route::get('edit', Profile::class)->name('users.edit');
    Route::get('create', UserCreate::class)->name('users.create');

});

Route::prefix('auth')->group(function() {

    Route::get('login', Login::class)->name('auth.login');

});

Route::middleware('auth')->group(function() {

    Route::get('home', Index::class)->name('home');

});
