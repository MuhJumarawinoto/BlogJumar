<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\UserRole;

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

Route::middleware(['auth'])->group(function(){
        Route::get('/home',[PostController::class,'index'])->name('post.index');
        Route::get('/post',[PostController::class,'create'])->name('post.create');
        Route::post('/post',[PostController::class,'store'])->name('post.store');
        Route::get('/post/{post}/edit',[PostController::class, 'edit'])->name('post.edit');
        // Route::patch('',[PostController::class,'update'])->name('post.update');
        Route::match(['put', 'patch'], '/post/{post}', [PostController::class, 'update'])->name('post.update');
        Route::delete('post/{post}',[PostController::class, 'delete'])->name('post.delete');
});

Route::get('/',[AuthController::class,'index'])->name('auth.login');
Route::post('actionlogin',[AuthController::class,'check'])->name('auth.check');
Route::get('/auth/register',[AuthController::class,'register'])->name('auth.register');
Route::post('/auth/tambah',[AuthController::class,'daftar'])->name('auth.tambah');
Route::get('/auth/logout',[AuthController::class,'logout'])->name('auth.logout');

// Route::middleware(['auth', 'role:admin'])->group(function () {
//         Route::get('/admin-index',[AdminController::class,'index'])->name('admin.index');
// });

Route::get('/dash', function () {
        // dd(auth()->user()->UserRole);
        //  dd(auth()->user()->role->user);
        $roles=(auth()->user()->role->name);
        // dd($roles);

        if ($roles === 'user') {
            // Akses diberikan hanya untuk pengguna dengan peran admin
            return 'Dashboard User';
        } elseif ($roles === 'admin') {
            // Akses diberikan hanya untuk pengguna dengan peran admin
            return 'Dashboard Admin';
        }
        else {
            // Jika tidak memenuhi kondisi, berikan pesan Unauthorized
            abort(403, 'Unauthorized');
        }
    })->middleware('auth');