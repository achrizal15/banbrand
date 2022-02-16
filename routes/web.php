<?php

use App\Http\Controllers\Admin\CustomerController;
use Illuminate\Support\Facades\Route;
//import use admin controller
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SellerController;

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
