<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryAppController;
use App\Http\Controllers\ApplicationFormsController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
// admin routs
    Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('admin');
    Route::post('/admin/addcategory', [CategoryAppController::class, 'store'])->middleware('admin')->name('admin-addcategory');
    Route::get('/admin/cat', [CategoryAppController::class, 'getAllCategories'])->name('get_all_categories')->middleware('admin');
    Route::get('/admin/deletecat/{id}', [CategoryAppController::class, 'deleteCatById'])->name('delete_cat_by_id')->middleware('admin');
    Route::get('/admin/apps', [ApplicationFormsController::class, 'adminIndex'])->name('admin_apps')->middleware('admin');
    // user2 routs
    Route::get('/backoffice', [ApplicationFormsController::class, 'index'])->name('backoffice')->middleware('user2');
    Route::post('/backoffice/addapp', [ApplicationFormsController::class, 'store'])->middleware('user2')->name('backoffice-addapp');
});
