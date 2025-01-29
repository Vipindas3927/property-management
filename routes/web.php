<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\PropertyController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [PropertyController::class, 'index'])->name('index');
Route::get('/add-view', [PropertyController::class, 'addview'])->name('addView');
Route::post('/add', [PropertyController::class, 'store'])->name('add');
Route::get('/delete/{id}', [PropertyController::class, 'delete'])->name('delete');
Route::get('/edit/{id}', [PropertyController::class, 'editView'])->name('edit');
Route::post('/edit-item/{id}', [PropertyController::class, 'update'])->name('properties.update');
