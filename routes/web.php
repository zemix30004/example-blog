<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PostsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', [DashboardController::class, 'index']);
});
Route::resource('admin/categories', 'App\Http\Controllers\Admin\CategoriesController');
Route::resource('admin/tags', 'App\Http\Controllers\Admin\TagsController');
Route::resource('admin/users', 'App\Http\Controllers\Admin\UsersController');
Route::resource('admin/posts', 'App\Http\Controllers\Admin\PostsController');
