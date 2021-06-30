<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LazadaProdController;
use App\Http\Controllers\LazopController;
use App\Http\Controllers\ProductKeluarController;
use App\Http\Controllers\ProductMasukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
	return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('dashboard', function () {
	return view('layouts.master');
});

// Route::group(['middleware' => 'auth'], function () {
	Route::resource('categories', CategoryController::class);
	Route::get('/apiCategories', [CategoryController::class, 'apiCategories'])->name('api.categories');
	Route::get('/exportCategoriesAll', [CategoryController::class, 'exportCategoriesAll'])->name('exportPDF.categoriesAll');
	Route::get('/exportCategoriesAllExcel', [CategoryController::class, 'exportExcel'])->name('exportExcel.categoriesAll');

	Route::resource('customers', CustomerController::class);
	Route::get('/apiCustomers', [CustomerController::class, 'apiCustomers'])->name('api.customers');
	Route::post('/importCustomers', [CustomerController::class, 'ImportExcel'])->name('import.customers');
	Route::get('/exportCustomersAll', [CustomerController::class, 'exportCustomersAll'])->name('exportPDF.customersAll');
	Route::get('/exportCustomersAllExcel', [CustomerController::class, 'exportExcel'])->name('exportExcel.customersAll');

	Route::resource('sales', SaleController::class);
	Route::get('/apiSales', [SaleController::class, 'apiSales'])->name('api.sales');
	Route::post('/importSales', [SaleController::class, 'ImportExcel'])->name('import.sales');
	Route::get('/exportSalesAll', [SaleController::class, 'exportSalesAll'])->name('exportPDF.salesAll');
	Route::get('/exportSalesAllExcel', [SaleController::class, 'exportExcel'])->name('exportExcel.salesAll');

	Route::resource('suppliers', SupplierController::class);
	Route::get('/apiSuppliers', [SupplierController::class, 'apiSuppliers'])->name('api.suppliers');
	Route::post('/importSuppliers', [SupplierController::class, 'ImportExcel'])->name('import.suppliers');
	Route::get('/exportSupplierssAll', [SupplierController::class, 'exportSuppliersAll'])->name('exportPDF.suppliersAll');
	Route::get('/exportSuppliersAllExcel', [SupplierController::class, 'exportExcel'])->name('exportExcel.suppliersAll');

	Route::resource('products', ProductController::class);
	Route::get('/apiProducts', [ProductController::class, 'apiProducts'])->name('api.products');

	Route::resource('lazadas', LazadaProdController::class);
	Route::get('/apiLazadas', [LazadaProdController::class, 'apiLazadas'])->name('api.lazadas');
	Route::get('/apiLazadas/detail/{idlazada}', [LazadaProdController::class, 'apiLazadasDetail'])->name('api.lazadas.detail');
	Route::get('/lazadas/detail/{id}', [LazadaProdController::class, 'detail'])->name('lazadas.detail');
	Route::post('/lazadas/detail', [LazadaProdController::class, 'saveDetail'])->name('lazadas.detail.saves');
	
	Route::get('/lazadasOrder', [OrderController::class, 'index'])->name('lazadasOrder');
	Route::get('/lazadasOrderDetail/{order_number}/{token}', [OrderController::class, 'detail']);

	Route::get('/lazadas/api/transactions', [LazopController::class, 'get_transaction']);
	Route::get('/lazadas/api/orders', [LazopController::class, 'get_orders']);

	Route::resource('productsOut', ProductKeluarController::class);
	Route::get('/apiProductsOut', [ProductKeluarController::class, 'apiProductsOut'])->name('api.productsOut');
	Route::get('/exportProductKeluarAll', [ProductKeluarController::class, 'exportProductKeluarAll'])->name('exportPDF.productKeluarAll');
	Route::get('/exportProductKeluarAllExcel', [ProductKeluarController::class, 'exportExcel'])->name('exportExcel.productKeluarAll');
	Route::get('/exportProductKeluar/{id}', [ProductKeluarController::class, 'exportProductKeluar'])->name('exportPDF.productKeluar');

	Route::resource('productsIn', ProductMasukController::class);
	Route::get('/apiProductsIn', [ProductMasukController::class, 'apiProductsIn'])->name('api.productsIn');
	Route::get('/exportProductMasukAll', [ProductMasukController::class, 'exportProductMasukAll'])->name('exportPDF.productMasukAll');
	Route::get('/exportProductMasukAllExcel', [ProductMasukController::class, 'exportExcel'])->name('exportExcel.productMasukAll');
	Route::get('/exportProductMasuk/{id}', [ProductMasukController::class, 'exportProductMasuk'])->name('exportPDF.productMasuk');

	Route::resource('user', UserController::class);
	Route::get('/apiUser', [UserController::class, 'apiUsers'])->name('api.users');
// });
