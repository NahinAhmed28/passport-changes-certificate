<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportChangeController;
use App\Http\Controllers\SignatureController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [PassportChangeController::class, 'index'])->name('passport.index');
Route::get('/create', [PassportChangeController::class, 'create'])->name('passport.create');
Route::post('/store', [PassportChangeController::class, 'store'])->name('passport.store');
Route::get('/details/{passportChange}', [PassportChangeController::class, 'show'])->name('passport.show');
Route::get('/edit/{passportChange}', [PassportChangeController::class, 'edit'])->name('passport.edit');
Route::post('/update/{passportChange}', [PassportChangeController::class, 'update'])->name('passport.update');
Route::get('/passport/{id}/print', [PassportChangeController::class, 'print'])->name('passport.print');
Route::get('/edit-signature', [SignatureController::class, 'edit'])->name('signature.edit');
Route::post('/signature/update/{id}', [SignatureController::class, 'update'])->name('signature.update');
