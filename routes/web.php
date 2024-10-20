<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Auth\Login;

use App\Livewire\Post\Index as PostsIndex;
use App\Livewire\Bookmark\Index as BookmarkIndex;
use App\Livewire\Notification\Index as NotificationIndex;

use App\Livewire\User\Profile;
use App\Livewire\User\Create as UserCreate;

Route::prefix('users')->group(function() {

    Route::get('create', UserCreate::class)->name('users.create');
    Route::get('profile/{userId}', Profile::class)->name('users.profile')->middleware('auth');

});

Route::prefix('auth')->group(function() {

    Route::get('login', Login::class)->name('auth.login');

});

Route::middleware('auth')->group(function() {

    Route::get('home', PostsIndex::class)->name('home');
    Route::get('bookmarks', BookmarkIndex::class)->name('bookmarks');
    Route::get('notifications', NotificationIndex::class)->name('notifications');

});
