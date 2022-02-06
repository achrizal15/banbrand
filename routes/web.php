<?php

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
    Route::resource("/sellers", SellerController::class)->names([
        "index" => "admin.sellers.index",
        "create" => "admin.sellers.create",
        "store" => "admin.sellers.store",
        "show" => "admin.sellers.show",
        "edit" => "admin.sellers.edit",
        "update" => "admin.sellers.update",
        "destroy" => "admin.sellers.destroy",
    ]);
});
