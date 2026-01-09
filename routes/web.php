<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

Route::get('/img/{path}', [ImageController::class, 'show'])->where('path', '.*');

Route::view('/', 'landing')->name('page.landing');
Route::view('/arbeiten', 'works')->name('page.works');
Route::view('/buero', 'about')->name('page.about');
