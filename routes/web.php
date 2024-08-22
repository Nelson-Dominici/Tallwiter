<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Auth\Login;

use App\Livewire\Dashboard\{
    Home,
    Profile
};
use App\Livewire\Post\Index;
use App\Livewire\User\Create as UserCreate;
use App\Livewire\User\Edit as UserEdit;

Route::prefix('users')->group(function() {

    Route::get('edit', UserEdit::class)->name('users.edit');
    Route::get('create', UserCreate::class)->name('users.create');

});

Route::prefix('auth')->group(function() {

    Route::get('login', Login::class)->name('auth.login');

});

Route::middleware('auth')->group(function() {

    Route::get('home', Index::class)->name('home');

});
