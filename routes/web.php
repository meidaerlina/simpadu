<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;

// Route::get('/', function () {
// return view('dashboard');
// });

Route::get('/', [DashboardController::class, 'index']);

Route::resource('/mahasiswa', MahasiswaController::class);
Route::resource('/prodi', ProdiController::class);


