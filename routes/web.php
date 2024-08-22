<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Supplier\SupplierController;
use App\Http\Controllers\Membership\MembershipController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Casier\CasierController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\Api\ApiTableController;
use App\Http\Controllers\TransactionDetail\TransactionDetailController;

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
    Route::get('/dashboard', [CasierController::class, 'index'])->name('dashboard');

    // supplier page
    Route::get('supplier', [SupplierController::class, 'index'])->name('supplier');
    Route::post('supplierstore', [SupplierController::class, 'supplierstore'])->name('supplier.store');
    Route::get('supplieredit/{id}', [SupplierController::class, 'supplieredit'])->name('supplier.edit');
    Route::put('supplierupdate', [SupplierController::class, 'supplierupdate'])->name('supplier.update');
    Route::delete('supplierdestroy', [SupplierController::class, 'supplierdestroy'])->name('supplier.destroy');
    Route::get('api/suppliers', [ApiTableController::class, 'load_datatable_supplier'])->name('api.suppliers');

    // customer page
    Route::get('customer', [MembershipController::class, 'index'])->name('customer');
    Route::get('customer/edit/{id}', [MembershipController::class, 'customer_edit'])->name('customer.edit');
    Route::post('customerstore', [MembershipController::class, 'customerstore'])->name('customer.store');
    Route::put('customerupdate', [MembershipController::class, 'customerupdate'])->name('customer.update');
    Route::delete('customerdestroy', [MembershipController::class, 'customerdestroy'])->name('customer.destroy');

    // categories page
    Route::get('categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('categoriesstore', [CategoryController::class, 'categoriesstore'])->name('categories.store');
    Route::get('categories/edit/{id}', [CategoryController::class, 'category_edit'])->name('categories.category_edit');
    Route::put('categoriesupdate/{id}', [CategoryController::class, 'categoriesupdate'])->name('categories.update');
    Route::delete('categoriesdestroy/{id}', [CategoryController::class, 'categoriesdestroy'])->name('categories.destroy');

    // units page
    Route::get('units', [PageController::class, 'indexunits'])->name('units');
    Route::post('unitsstore', [PageController::class, 'unitsstore'])->name('units.store');
    Route::put('unitsupdate/{id}', [PageController::class, 'unitsupdate'])->name('units.update');
    Route::delete('unitsdestroy/{id}', [PageController::class, 'unitsdestroy'])->name('units.destroy');

    // items page
    Route::get('items', [PageController::class, 'indexitems'])->name('items');
    Route::get('itemscreate', [PageController::class, 'itemscreate'])->name('items.create');
    Route::delete('itemsdestroy/{id}', [PageController::class, 'itemsdestroy'])->name('items.destroy');

    // Route transaction
    Route::post('/pay-order', [TransactionController::class, 'pay_order'])->name('pay.order');

    // Route history transaction
    Route::get('/get/all-transaction/', [TransactionController::class, 'get_all_transaction'])->name('all.transaction');

    // load data for datatable
    Route::get('/get/data/transactio/api', [ApiTableController::class, 'load_data_transaction'])->name('load.data.transaction');
    Route::get('/detail/transaction/{id}', [TransactionDetailController::class, 'detail_transaction'])->name('view.detail.transaction');
});

// Route::get('/dashboard', function () {
//     return view('layouts.kasir.index');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
