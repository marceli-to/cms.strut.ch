<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\MediaController;

Route::prefix('dashboard')
	->middleware(['web', 'auth'])
	->group(function () {

		Route::get('/', [DashboardController::class, 'index']);

		Route::controller(ProjectController::class)
			->prefix('projects')
			->group(function () {
				Route::get('/', 'index');
				Route::post('/', 'store');
				Route::get('/categories', 'categories');
				Route::get('/{project}', 'show');
				Route::put('/{project}', 'update');
				Route::delete('/{project}', 'destroy');
			});

		Route::controller(MediaController::class)
			->prefix('media')
			->group(function () {
				Route::get('/', 'index');
				Route::post('/upload', 'upload');
				Route::put('/{media}', 'update');
				Route::delete('/{media}', 'destroy');
				Route::patch('/reorder', 'reorder');
				Route::patch('/{media}/teaser', 'teaser');
			});

	});
