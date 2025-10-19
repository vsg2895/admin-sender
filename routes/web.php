<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'is.admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('clients', ClientController::class);
    Route::resource('templates', TemplateController::class);
    Route::post('template-run/{templateId}', [TemplateController::class, 'run'])->name('template.run');
});

require __DIR__.'/auth.php';
