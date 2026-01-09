<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

Route::get('/img/{path}', [ImageController::class, 'show'])->where('path', '.*');

Route::view('/', 'pages.landing')->name('page.landing');
Route::view('/arbeiten', 'pages.works.index')->name('page.works');
Route::view('/arbeiten/{slug}', 'pages.works.show')->name('page.works.show');
Route::view('/buero', 'pages.about')->name('page.about');
Route::view('/suche', 'pages.search')->name('page.search');
