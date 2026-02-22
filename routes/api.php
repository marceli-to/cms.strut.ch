<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\ProjectGridController;

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
				Route::patch('/{project}/publish', 'togglePublish');
				Route::delete('/{project}', 'destroy');
			});

		Route::controller(ProjectGridController::class)
			->prefix('projects/{project}/grids')
			->group(function () {
				Route::get('/layouts', 'layouts');
				Route::get('/', 'index');
				Route::post('/', 'store');
				Route::patch('/reorder', 'reorder');
				Route::delete('/{grid}', 'destroy');
				Route::post('/{grid}/items', 'storeItem');
				Route::delete('/{grid}/items/{item}', 'destroyItem');
			});

		Route::controller(CategoryController::class)
			->prefix('categories')
			->group(function () {
				Route::get('/', 'index');
				Route::post('/', 'store');
				Route::put('/{category}', 'update');
				Route::patch('/{category}/publish', 'togglePublish');
				Route::delete('/{category}', 'destroy');
				Route::post('/{category}/types', 'storeType');
				Route::patch('/{category}/types/reorder', 'reorderTypes');
				Route::put('/{category}/types/{type}', 'updateType');
				Route::delete('/{category}/types/{type}', 'destroyType');
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
