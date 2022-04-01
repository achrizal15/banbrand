<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SellerController;
//import use admin controller
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Seller\DashboardController as SellerDashboardController;
use App\Http\Controllers\Seller\PricePackageController;
use App\Http\Controllers\Seller\ProdukController;
use App\Http\Controllers\WelcomeController;
use App\Models\PricePackage;

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

Route::get('/', [WelcomeController::class, "index"])->name("welcome");
Route::get("/login/{params}", [AuthController::class, "index"])->name("login");
Route::get("/register/{params}", [AuthController::class, "register"])->name("register");
Route::post("/create/{params}", [AuthController::class, "create"])->name("createaccount");
Route::group(["prefix" => "sellers"], function () {
    Route::get("/", [SellerDashboardController::class, "index"])->name("sellers");
    Route::resource("/product", ProdukController::class)->names([
        'index' => 'sellers.product.index',
        'create' => 'sellers.product.create',
        'destroy' => 'sellers.product.destroy',
        'store' => 'sellers.product.store',
        'update' => 'sellers.product.update',
        'edit' => 'sellers.product.edit',
    ]);
    Route::get("/product/{product}/price", [PricePackageController::class, "index"])->name("product.price");
    Route::get("/product/{product}/price/action", [PricePackageController::class, "action"])->name("product.price.action");
    Route::post("/product/price", [PricePackageController::class, "store"])->name("product.price.store");
    Route::PUT("/product/price/{price}", [PricePackageController::class, "update"])->name("product.price.update");
    Route::delete("/product/price/{price}",[PricePackageController::class,"destroy"])->name("product.price.destroy");
});
//route get admin controller
Route::group(["prefix" => "admin"], function () {
    //route get admin controller
    Route::get("/", [DashboardController::class, "index"])->name("admin");
    //route sellers
    Route::put("/sellers/pw-reset/{seller}", [SellerController::class, "password_reset"])->name("admin.sellers.pw-reset");
    Route::resource("/sellers", SellerController::class)->names([
        "index" => "admin.sellers.index",
        "create" => "admin.sellers.create",
        "store" => "admin.sellers.store",
        "show" => "admin.sellers.show",
        "edit" => "admin.sellers.edit",
        "update" => "admin.sellers.update",
        "destroy" => "admin.sellers.destroy",
    ]);
    Route::resource('/products', ProductController::class)->names([
        "index" => "admin.products.index",
        "create" => "admin.products.create",
        "store" => "admin.products.store",
        "show" => "admin.products.show",
        "edit" => "admin.products.edit",
        "update" => "admin.products.update",
        "destroy" => "admin.products.destroy",
    ]);
    Route::resource("/categorys", ProductCategoryController::class)->names([
        "index" => "admin.categorys.index",
        "create" => "admin.categorys.create",
        "store" => "admin.categorys.store",
        "show" => "admin.categorys.show",
        "edit" => "admin.categorys.edit",
        "update" => "admin.categorys.update",
        "destroy" => "admin.categorys.destroy",
    ]);
    Route::resource("/customers", CustomerController::class)->names([
        "index" => "admin.customers.index",
        "create" => "admin.customers.create",
        "store" => "admin.customers.store",
        "show" => "admin.customers.show",
        "edit" => "admin.customers.edit",
        "update" => "admin.customers.update",
        "destroy" => "admin.customers.destroy",
    ]);
});
