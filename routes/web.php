<?php

use App\Http\Controllers\PelangganController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('pelanggan.index'));
Route::resource('pelanggan', PelangganController::class)->except('show');