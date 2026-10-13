<?php

use App\Livewire\Trabajadores\Index;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/trabajadores');

Route::middleware('auth')->group(function () {
    Route::get('/trabajadores', Index::class)->name('trabajadores.index');
});
