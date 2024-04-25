<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
// use Auth;
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

// Route::get('/', [AuthController::class, 'show'])->name('login');

// Route::post('/login', [AuthController::class, 'login']);

// Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');

// Route::get('/logout', [AuthController::class, 'logout'])->name('logout');




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin', function() {
    return view('admin.admin');
})->name('dashboard');

Route::get('post', [PostController::class, 'index'])->middleware('auth');
Route::get('post/{id}', [PostController::class, 'show'])->middleware('auth');

Route::middleware('auth')->prefix('admin')->group(function() {
    Route::prefix('post')->group(function(){
        Route::get('create', [PostController::class, 'create'])->name('post_create');
        Route::post('create', [PostController::class, 'store']); 

        Route::get('your-post', [PostController::class, 'getUserPost'])->name('admin_post');

        Route::get('update/{id}', [PostController::class, 'edit'])->name('post_update')->middleware('post.valid');
        Route::post('update/{id}', [PostController::class, 'update'])->name('update_post');

        Route::delete('delete/{id}', [PostController::class, 'delete'])->name('post_delete');
    });
});


