<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Category;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\Adminstration;
use App\Http\Controllers\Admin\AdminstrationController;

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/system', function () {
    return view('system');
})->name('system');

Route::get('/policy', function () {
    return view('policy');
})->name('policy');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/', [HomeController::class, 'index']);





/* ROUTE ADMIN */
Route::get('category', [Category::class, 'index'])->name('category');
Route::get('addCategory', [Category::class, 'categoryAdd'])->name('addCategory');
Route::post('add-Category', [Category::class, 'categoryAdd']);
Route::get('editCategory/{id}', [Category::class, 'categoryEdit'])->name('editCategory');
Route::put('editCategory/{id}', [Category::class, 'categoryUpdate'])->name('UpdateCategory');
Route::post('deleteCategory', [Category::class, 'categoryDeleteCheckbox'])->name('deleteCategory');


Route::get('adminstration', [AdminstrationController::class, 'adminstration'])->name('adminstration');
Route::get('addAdminstration', [AdminstrationController::class, 'adminstrationAdd'])->name('addAdminstration');
Route::post('add-Adminstration', [AdminstrationController::class, 'adminstrationAdd']);
Route::get('editAdminstration/{id}', [AdminstrationController::class, 'adminstrationEdit'])->name('editAdminstration');
Route::put('editAdminstration/{id}', [AdminstrationController::class, 'adminstrationUpdate'])->name('UpdateAdminstration');
Route::post('deleteAdminstration', [AdminstrationController::class, 'adminstrationDeleteCheckbox'])->name('deleteAdminstration');


Route::get('adminstrationGroup', [AdminstrationController::class, 'adminstrationGroup'])->name('adminstrationGroup');
Route::get('addAdminstrationGroup', [AdminstrationController::class, 'adminstrationGroupAdd'])->name('addAdminstrationGroup');
Route::post('add-AdminstrationGroup', [AdminstrationController::class, 'adminstrationGroupAdd'])->name('addFormAdminstrationGroup');
Route::get('editAdminstrationGroup/{id}', [AdminstrationController::class, 'adminstrationGroupEdit'])->name('editAdminstrationGroup');
Route::put('editAdminstrationGroup/{id}', [AdminstrationController::class, 'adminstrationGroupUpdate']);
Route::post('deleteAdminstrationGroup', [AdminstrationController::class, 'adminstrationGroupDeleteCheckbox'])->name('deleteAdminstrationGroup');