<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Category\CategoriesList;
use App\Livewire\Admin\Category\CategoriesTable;
use App\Http\Controllers\Admin\ProductController;
use App\Livewire\Admin\Category\CategoriesCreate;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'login', 'middleware' => 'CheckAdminLoggedIn'], function () {
        Route::get('', [AuthController::class, 'getLogin'])->name('admin.get.login');
        Route::post('', [AuthController::class, 'postLogin'])->name('admin.post.login');
        Route::get('logout', [AuthController::class, 'getLogout'])->name('admin.get.logout');
    });

    Route::group(['prefix' => '', 'middleware' => 'CheckAdminLoggedOut'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.index');
        Route::get('logout', [AuthController::class, 'getLogout'])->name('admin.get.logout');
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UserController::class, 'index'])->name('user.index');
            Route::get('create', [UserController::class, 'getCreate'])->name('user.get.create');
            Route::post('create', [UserController::class, 'postCreate'])->name('user.post.create');
            Route::get('edit/{id}', [UserController::class, 'getEdit'])->name('user.get.edit');
            Route::post('edit/{id}', [UserController::class, 'postEdit'])->name('user.post.edit');
            Route::get('delete/{id}', [UserController::class, 'delete'])->name('user.get.delete');
        });
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('category.index');
            Route::get('create', [CategoryController::class, 'getCreate'])->name('category.get.create');
            Route::post('create', [CategoryController::class, 'postCreate'])->name('category.post.create');
            Route::get('edit/{id}', [CategoryController::class, 'getEdit'])->name('category.get.edit');
            Route::post('edit/{id}', [CategoryController::class, 'postEdit'])->name('category.post.edit');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category.get.delete');
        });
        Route::group(['prefix' => 'products'], function () {
            Route::get('/', [ProductController::class, 'index'])->name('product.index');
            Route::get('create', [ProductController::class, 'getCreate'])->name('product.get.create');
            Route::post('create', [ProductController::class, 'postCreate'])->name('product.post.create');
            Route::get('edit/{id}', [ProductController::class, 'getEdit'])->name('product.get.edit');
            Route::post('edit/{id}', [ProductController::class, 'postEdit'])->name('product.post.edit');
            Route::get('delete/{id}', [ProductController::class, 'delete'])->name('product.get.delete');
        });
        Route::group(['prefix' => 'articles'], function () {
            Route::get('/', [ArticleController::class, 'index'])->name('article.index');
            Route::get('create', [ArticleController::class, 'getCreate'])->name('article.get.create');
            Route::post('create', [ArticleController::class, 'postCreate'])->name('article.post.create');
            Route::get('edit/{id}', [ArticleController::class, 'getEdit'])->name('article.get.edit');
            Route::post('edit/{id}', [ArticleController::class, 'postEdit'])->name('article.post.edit');
            Route::get('delete/{id}', [ArticleController::class, 'delete'])->name('article.get.delete');
        });
    });


});
