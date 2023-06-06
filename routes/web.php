<?php

use App\Http\Controllers\PostController;
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



Route::get('/post',[PostController::class,'create'])->name('post.create');
Route::get('/',[PostController::class,'index'])->name('post.index');
Route::post('/post',[PostController::class,'store'])->name('post.store');
Route::get('/post/{id}/edit',[PostController::class, 'edit'])->name('post.edit');