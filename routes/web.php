<?php

use App\Mail\User\PasswordMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/', \App\Http\Controllers\Main\IndexController::class)->name('main');

Route::prefix('/posts')->name('posts.')->group(function () {
    Route::get('/', \App\Http\Controllers\Post\IndexController::class)->name('index');
    Route::get('/{post}', \App\Http\Controllers\Post\ShowController::class)->name('show');

    Route::prefix('/{post}/comments')->name('comments.')->group(function () {
        Route::post('/', \App\Http\Controllers\Post\Comment\StoreController::class)->name('store');
    });

    Route::prefix('/{post}/likes')->name('likes.')->group(function (){
        Route::post('/', \App\Http\Controllers\Post\Like\StoreController::class)->name('store');
    });
});

Route::prefix('/categories')->name('categories.')->group(function () {
    Route::get('/{category}/posts', \App\Http\Controllers\Category\Post\IndexController::class)->name('posts.index');
});

Route::prefix('/admin')->name('admin.')->middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/', \App\Http\Controllers\Admin\Main\IndexController::class)->name('index');

    Route::prefix('/categories')->name('categories.')->group(function () {
        Route::get('/', \App\Http\Controllers\Admin\Category\IndexController::class)->name('index');
        Route::get('/create', \App\Http\Controllers\Admin\Category\CreateController::class)->name('create');
        Route::post('/', \App\Http\Controllers\Admin\Category\StoreController::class)->name('store');
        Route::get('/{category}', \App\Http\Controllers\Admin\Category\ShowController::class)->name('show');
        Route::get('/{category}/edit', \App\Http\Controllers\Admin\Category\EditController::class)->name('edit');
        Route::patch('/{category}', \App\Http\Controllers\Admin\Category\UpdateController::class)->name('update');
        Route::delete('/{category}', \App\Http\Controllers\Admin\Category\DeleteController::class)->name('delete');
    });

    Route::prefix('/tags')->name('tags.')->group(function () {
        Route::get('/', \App\Http\Controllers\Admin\Tag\IndexController::class)->name('index');
        Route::get('/create', \App\Http\Controllers\Admin\Tag\CreateController::class)->name('create');
        Route::post('/', \App\Http\Controllers\Admin\Tag\StoreController::class)->name('store');
        Route::get('/{tag}', \App\Http\Controllers\Admin\Tag\ShowController::class)->name('show');
        Route::get('/{tag}/edit', \App\Http\Controllers\Admin\Tag\EditController::class)->name('edit');
        Route::patch('/{tag}', \App\Http\Controllers\Admin\Tag\UpdateController::class)->name('update');
        Route::delete('/{tag}', \App\Http\Controllers\Admin\Tag\DeleteController::class)->name('delete');
    });

    Route::prefix('/posts')->name('posts.')->group(function () {
        Route::get('/', \App\Http\Controllers\Admin\Post\IndexController::class)->name('index');
        Route::get('/create', \App\Http\Controllers\Admin\Post\CreateController::class)->name('create');
        Route::post('/', \App\Http\Controllers\Admin\Post\StoreController::class)->name('store');
        Route::get('/{post}', \App\Http\Controllers\Admin\Post\ShowController::class)->name('show');
        Route::get('/{post}/edit', \App\Http\Controllers\Admin\Post\EditController::class)->name('edit');
        Route::patch('/{post}', \App\Http\Controllers\Admin\Post\UpdateController::class)->name('update');
        Route::delete('/{post}', \App\Http\Controllers\Admin\Post\DeleteController::class)->name('delete');
    });

    Route::prefix('/users')->name('users.')->group(function () {
        Route::get('/', \App\Http\Controllers\Admin\User\IndexController::class)->name('index');
        Route::get('/create', \App\Http\Controllers\Admin\User\CreateController::class)->name('create');
        Route::post('/', \App\Http\Controllers\Admin\User\StoreController::class)->name('store');
        Route::get('/{user}', \App\Http\Controllers\Admin\User\ShowController::class)->name('show');
        Route::get('/{user}/edit', \App\Http\Controllers\Admin\User\EditController::class)->name('edit');
        Route::patch('/{user}', \App\Http\Controllers\Admin\User\UpdateController::class)->name('update');
        Route::delete('/{user}', \App\Http\Controllers\Admin\User\DeleteController::class)->name('delete');
    });
});

Route::prefix('/personal')->name('personal.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', \App\Http\Controllers\Personal\Main\IndexController::class)->name('index');

    Route::prefix('/liked')->name('liked.')->group(function () {
        Route::get('/', \App\Http\Controllers\Personal\Liked\IndexController::class)->name('index');
        Route::delete('/{post}', \App\Http\Controllers\Personal\Liked\DeleteController::class)->name('delete');
    });

    Route::prefix('/comments')->name('comments.')->group(function () {
        Route::get('/', \App\Http\Controllers\Personal\Comment\IndexController::class)->name('index');
        Route::get('/{comment}/edit', \App\Http\Controllers\Personal\Comment\EditController::class)->name('edit');
        Route::patch('/{comment}', \App\Http\Controllers\Personal\Comment\UpdateController::class)->name('update');
        Route::delete('/{comment}', \App\Http\Controllers\Personal\Comment\DeleteController::class)->name('delete');
    });

    Route::prefix('/settings')->name('settings.')->group(function () {
        Route::get('/', \App\Http\Controllers\Personal\Settings\IndexController::class)->name('index');
        Route::get('/edit', \App\Http\Controllers\Personal\Settings\EditController::class)->name('edit');
        Route::patch('/{user}', \App\Http\Controllers\Personal\Settings\UpdateController::class)->name('update');
    });
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('auth.google');

Route::get('auth/google/callback', \App\Http\Controllers\Auth\LoginByGoogleController::class);
