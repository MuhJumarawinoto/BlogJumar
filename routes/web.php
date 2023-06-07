<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
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


Route::get('/home',[PostController::class,'index'])->name('post.index');
Route::get('/post',[PostController::class,'create'])->name('post.create');
Route::post('/post',[PostController::class,'store'])->name('post.store');
Route::get('/post/{post}/edit',[PostController::class, 'edit'])->name('post.edit');
// Route::patch('',[PostController::class,'update'])->name('post.update');
Route::match(['put', 'patch'], '/post/{post}', [PostController::class, 'update'])->name('post.update');
Route::delete('post/{post}',[PostController::class, 'delete'])->name('post.delete');


Route::get('/',[AuthController::class,'index'])->name('auth.login');
Route::get('/auth/register',[AuthController::class,'register'])->name('auth.register');
Route::post('/auth/tambah',[AuthController::class,'daftar'])->name('auth.tambah');