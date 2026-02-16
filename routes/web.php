<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [MainController::class, 'showIndex'])-> name('home');
Route::get('/', [MainController::class, 'showArray'])-> name('array');