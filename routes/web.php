<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Forum\TopicList;
use App\Livewire\Forum\CreateTopic;
use App\Livewire\Forum\TopicView;

Route::middleware(['auth'])->group(function () {
    // Forum routes
    Route::get('/forum', TopicList::class)->name('forum.index');
    Route::get('/forum/create', CreateTopic::class)->name('topics.create');
    Route::get('/forum/topics/{topic}', TopicView::class)->name('topics.show');
});

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
