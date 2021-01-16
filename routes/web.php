<?php

use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostsController;
use App\Http\Controllers\AuthController;

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
Route::delete('/delete/{id}', [PostsController::class, 'deleteById'])->name('del');
Route::get('/post/{id}', [PostsController::class, 'show_post'])->name('show_post');
Route::get('/tag/{id}', [PostsController::class, 'tag'])->name('tag');
Route::get('/', [PostsController::class, 'show'])->name("home")->middleware("auth");
Route::post('/posts/{post}/approve', [PostsController::class, 'approve'])->name('approve');
Route::get('/mail/create', [MailController::class, 'create_mail'])->name('create_mail');
Route::post('/mail/send', [MailController::class, 'send'])->name('send');



Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('post_register');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('post_login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group([
	'middleware' => 'auth',
	'prefix' => 'posts'
], function() {

	Route::get('/', [PostsController::class, 'index'])->name('posts');

    Route::get('/my-posts', [PostsController::class, 'ownPosts'])->name('ownposts');

    Route::get('/create', [PostsController::class, 'create'])->name('posts.create');
    Route::post('/create', [PostsController::class, 'createPostRecord'])->name('posts.create');

    Route::get('/{id}/update/', [PostsController::class, 'update'])->name('edit');
    Route::put('/{id}/update/save', [PostsController::class, 'updateRecord'])->name('update');

});
