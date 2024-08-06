<?php

use App\Http\Controllers\authcontroller;
use App\Http\Controllers\CategoryController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('isLogin')->group(function(){


    Route::get('/index/show/{id}',[PostController::class,'show'])->name('posts.show');
    
    Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');
    Route::post('/posts/store',[PostController::class,'store'])->name('posts.store');
    
    
    Route::get('/posts/edit/{id}',[PostController::class,'edit'])->name('posts.edit');
    Route::post('/posts/update/{id}',[PostController::class,'updatee'])->name('posts.update');
    
    Route::get('/posts/delete/{id}',[PostController::class,'delete'])->name('posts.delete');
    Route::get('myposts',[PostController::class,'myposts'])->name('posts.myposts');

});

Route::get('/register',[authcontroller::class,'register'])->name('users.register');
Route::post('/handelregister',[authcontroller::class,'handelregister'])->name('users.handelregister');


Route::get('/login',[authcontroller::class,'login'])->name('users.login');
Route::post('/handellogin',[authcontroller::class,'handellogin'])->name('users.handellogin');

Route::get('/logout',[authcontroller::class,'logout'])->name('users.logout');

///////////////////////////////////////////////
Route::get('/auth/redirect',[authcontroller::class,'redirect'])->name('users.redirect');    
Route::get('/auth/callback',[authcontroller::class,'callback'])->name('users.callback');


Route::get('/auth/redirectgoog',[authcontroller::class,'redirectgoog'])->name('users.redirectgoog');    
Route::get('/auth/callbackgoog',[authcontroller::class,'callbackgoog'])->name('users.callbackgoog');


//////////////////////////////////////////////////////////////////////////////////////////

Route::get('/index/posts',[PostController::class,'index'])->name('posts.index');

///////////////////////////////////////////////////////////////////////////////////////////////

Route::get('/posts/search',[PostController::class,'search'])->name('posts.search');
/////////////////////////////////////////////////////////////////////////////
Route::get('/category/index',[CategoryController::class,'index'])->name('category.index');
Route::get('/category/show/{id}',[CategoryController::class,'show'])->name('category.show');

Route::get('category/create',[CategoryController::class,'create'])->name('category.create');
Route::post('category/store',[CategoryController::class,'store'])->name('category.store');

Route::get('category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
Route::post('category/update/{id}',[CategoryController::class,'update'])->name('category.update');

Route::get('category/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');
