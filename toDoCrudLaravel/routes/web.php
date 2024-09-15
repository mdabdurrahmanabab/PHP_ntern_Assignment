<?php

use App\Http\Controllers\ToDoController;
use Illuminate\Support\Facades\Route;


Route::get('/',[ToDoController::class,'index']);
Route::post('/store',[ToDoController::class,'store'])->name('todo.store');
Route::delete('/destroy/{id}',[ToDoController::class,'destroy'])->name('todo.destroy');
