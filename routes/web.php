<?php

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

Route::get('/create-post', [PostController::class, 'createPost'])->middleware('auth');
Route::post('/create-post', [PostController::class, 'store'])->middleware('auth');
Route::get('/{post}/edit-post', [PostController::class, 'editPost'])->middleware('auth');
Route::patch('/{post}/update-post', [PostController::class, 'updatePost'])->middleware('auth');
Route::get('/post/{post}', [PostController::class, 'viewSinglePost']);
Route::delete('/delete/{post}', [PostController::class, 'delete']);


Route::get('/profile/{user:username}', [UserController::class, 'profile'])->middleware('auth');
