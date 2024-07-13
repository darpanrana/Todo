<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'guest'],function(){

    Route::get('/register',[TodoController::class,'register'])->name('register');
    Route::post('/verify',[TodoController::class,'verify_registration'])->name('verify_registeration');
    Route::get('/login',[TodoController::class,'login'])->name('login');
    Route::post('/login_process',[TodoController::class,'verify_login'])->name('verify_login');

});

Route::group(['middleware' => 'auth'],function(){

    Route::get('/home',[TodoController::class,'home'])->name('home');
    Route::get('/task',[TodoController::class,'task'])->name('task');
    Route::post('/add_task',[TodoController::class,'add_task'])->name('add_task');
    Route::post('/edit_task/{id}',[TodoController::class,'edit_task'])->name('edit_task');
    Route::post('/task_done/{id}',[TodoController::class,'task_done'])->name('task_done');
    Route::post('/task_delete/{id}',[TodoController::class,'task_delete'])->name('task_delete');
    Route::get('/logout',[TodoController::class,'logout'])->name('logout');

});