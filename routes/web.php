<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\FlavorController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockCartController;
use App\Http\Controllers\AumentosController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SecurityController;


use Illuminate\Support\Facades\Route;
Route::get('/', HomeController::class)->name('dashboard');

// rutas para los productos
Route::resource('products', ProductController::class);
Route::get('products/{product}/details',[ProductController::class,'details'])->name('products.details');
Route::get('products/{product}/complete',[ProductController::class,'complete'])->name('products.complete');
Route::get('products/{product}/valor',[ProductController::class,'valor'])->name('products.valor');
//rutas para el carrito de ventas 
Route::resource('cart', CartController::class);

//rutas para administrar las ventas
Route::resource('sales', SaleController::class);

// rutas para administra las marcas 
Route::resource('brands', BrandController::class);

// rutas para admitistra las razas 
Route::resource('races', RaceController::class);

//rutas para administrar los proveedores 
Route::resource('providers', ProviderController::class);

//rutas para administrar los sabores 
Route::resource('flavors', FlavorController::class);

//rutas para administrar las configuraciones 
Route::resource('configurations',ConfigurationController::class);

//rutas para controlar el carrito de compras 
Route::resource('stockCart',StockCartController::class);

// rutas para los aumentos
 Route::resource('aumentos',AumentosController::class);

// rutas para las compras 
Route::resource('purchases',PurchaseController::class);

// rutas para el stock
Route::resource('stock',StockController::class);

// rutas de seguridad
Route::resource('security',SecurityController::class);