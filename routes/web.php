<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CompaniesController;
use App\Http\Controllers\admin\EmployesController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', [HomeController::class, 'index']);

Route::middleware('set_locale')->group(function() {
    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::get('/locale/{locale}', [HomeController::class, 'changeLocale'])->name('locale');
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('employes/getAll', [EmployesController::class, 'getAll'])->name('employes.getall');
        Route::get('companies/getAll', [CompaniesController::class, 'getAll'])->name('companies.getall');
        Route::post('companies/update2/{id}', [CompaniesController::class, 'update2']);
        Route::resource('employes', EmployesController::class);
        Route::resource('companies', CompaniesController::class);
    });
});



