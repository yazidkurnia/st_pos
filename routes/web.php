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
    Route::get('supplier', [PageController::class, 'indexsupplier'])->name('supplier');
    Route::post('supplierstore', [PageController::class, 'supplierstore'])->name('supplier.store');
    Route::get('supplieredit/{id}', [PageController::class, 'supplieredit'])->name('supplier.edit');
    Route::put('supplierupdate/{id}', [PageController::class, 'supplierupdate'])->name('supplier.update');
    Route::delete('supplierdestroy/{id}', [PageController::class, 'supplierdestroy'])->name('supplier.destroy');
});

// Route::get('/dashboard', function () {
//     return view('layouts.kasir.index');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
