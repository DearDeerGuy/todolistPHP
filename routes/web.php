<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [App\Http\Controllers\UserController::class, 'login']);
Route::post('/login',   [App\Http\Controllers\UserController::class, 'authenticate']);

Route::get('/register',   [App\Http\Controllers\UserController::class, 'register']);
Route::post('/register',   [App\Http\Controllers\UserController::class, 'registerUser']);

Route::get('/logout',   [App\Http\Controllers\UserController::class, 'logout'])->middleware('auth');

//Route::get('/category', [App\Http\Controllers\ToDoListController::class, 'category'])->middleware('auth');
//Route::post('/addcategory', [App\Http\Controllers\ToDoListController::class, 'addCategory'])->middleware('auth');
//Route::post('/editcategory', [App\Http\Controllers\ToDoListController::class, 'editCategory'])->middleware('auth');

Route::get('/main', [App\Http\Controllers\ToDoListController::class, 'main'])->middleware('auth');
Route::post('/addlist', [App\Http\Controllers\ToDoListController::class, 'addList'])->middleware('auth');
Route::get('/details', [App\Http\Controllers\ToDoListController::class, 'details'])->middleware('auth');
Route::post('/makechecked', [App\Http\Controllers\ToDoListController::class, 'makeChecked'])->middleware('auth');
Route::post('/additem', [App\Http\Controllers\ToDoListController::class, 'addItem'])->middleware('auth');
Route::post('/deleteitem', [App\Http\Controllers\ToDoListController::class, 'deleteItem'])->middleware('auth');
Route::post('/sharelist', [App\Http\Controllers\ToDoListController::class, 'shareList'])->middleware('auth');
