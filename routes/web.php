<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function(){
    Route::get('dashboard', function() { return view('layouts.kasir.index'); })->name('dashboard');

    // supplier page
    Route::get('supplier', [PageController::class, 'indexsupplier'])->name('supplier');
    Route::post('supplierstore', [PageController::class, 'supplierstore'])->name('supplier.store');
    Route::get('supplieredit/{id}', [PageController::class, 'supplieredit'])->name('supplier.edit');
    Route::put('supplierupdate/{id}', [PageController::class, 'supplierupdate'])->name('supplier.update');
    Route::delete('supplierdestroy/{id}', [PageController::class, 'supplierdestroy'])->name('supplier.destroy');

    // customer page
    Route::get('customer', [PageController::class, 'indexcustomer'])->name('customer');
    Route::post('customerstore', [PageController::class, 'customerstore'])->name('customer.store');
    Route::put('customerupdate/{id}', [PageController::class, 'customerupdate'])->name('customer.update');
    Route::delete('customerdestroy/{id}', [PageController::class, 'customerdestroy'])->name('customer.destroy');

    // categories page
    Route::get('categories', [PageController::class, 'indexcategories'])->name('categories');
    Route::post('categoriesstore', [PageController::class, 'categoriesstore'])->name('categories.store');
    Route::put('categoriesupdate/{id}', [PageController::class, 'categoriesupdate'])->name('categories.update');
    Route::delete('categoriesdestroy/{id}', [PageController::class, 'categoriesdestroy'])->name('categories.destroy');

    // units page
    Route::get('units', [PageController::class, 'indexunits'])->name('units');
    Route::post('unitsstore', [PageController::class, 'unitsstore'])->name('units.store');
    Route::put('unitsupdate/{id}', [PageController::class, 'unitsupdate'])->name('units.update');
    Route::delete('unitsdestroy/{id}', [PageController::class, 'unitsdestroy'])->name('units.destroy');
});

// Route::get('/dashboard', function () {
//     return view('layouts.kasir.index');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
