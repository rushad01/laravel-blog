<?php

use App\Http\Controllers\FollowerController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [UserController::class, 'showCorrectHomepage'])->name('login');
Route::post('/register', [UserController::class, 'register'])->middleware('guest');
Route::post('/login', [UserController::class, 'login'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
//Follower adding 
Route::post('/new_follow/{user:username}', [FollowerController::class, 'newFollow'])->middleware('auth');
Route::post('/remove_follow/{user:username}', [FollowerController::class, 'removeFollow']);

Route::get('/create_post', [PostController::class, 'createPost'])->middleware('auth');
Route::post('/create_post', [PostController::class, 'store'])->middleware('auth');
Route::get('/{post}/edit_post', [PostController::class, 'editPost'])->middleware('auth');
Route::patch('/{post}/update_post', [PostController::class, 'updatePost'])->middleware('auth');
Route::get('/post/{post}', [PostController::class, 'viewSinglePost']);
Route::delete('/delete/{post}', [PostController::class, 'delete']);


Route::get('/profile/{user:username}', [UserController::class, 'profile']);

//chating feature
Route::get('/chat', function () {
    return view('blog-chat');
});
