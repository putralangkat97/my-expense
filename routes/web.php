<?php

use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::name('transaction.')
        ->prefix('/transaction')
        ->group(function () {
            Route::get('/', \App\Livewire\Transaction\Index::class)
                ->name('index');
            Route::get('/create', \App\Livewire\Transaction\Form::class)
                ->name('create');
            Route::get('/{transaction}/show', \App\Livewire\Transaction\Show::class)
                ->name('show');
            Route::get('/{transaction}/edit', \App\Livewire\Transaction\Form::class)
                ->name('edit');
        });

    Route::controller(\App\Http\Controllers\ProfileController::class)
        ->name('profile.')
        ->prefix('/profile')
        ->group(function () {
            Route::get('/', 'edit')->name('edit');
            Route::patch('/', 'update')->name('update');
            Route::delete('/', 'destroy')->name('destroy');
        });
});
