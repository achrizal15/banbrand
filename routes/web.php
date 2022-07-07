<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SellerController;
//import use admin controller
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\DetailPembayaranController;
use App\Http\Controllers\ProductGaleryController;
use App\Http\Controllers\Seller\DashboardController as SellerDashboardController;
use App\Http\Controllers\Seller\PricePackageController;
use App\Http\Controllers\Seller\ProdukController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\UserController;

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
Route::post("/auth/{params}", [AuthController::class, "auth"])->name("loginAuth");
Route::get("/logout/{guard}", [AuthController::class, "logOut"])->name("logOut");
Route::get("/register/{params}", [AuthController::class, "register"])->name("register");
Route::post("/create/{params}", [AuthController::class, "create"])->name("createaccount");
Route::get("/toko/{toko}", [WelcomeController::class, "toko"])->name("toko");
Route::get("/produk-detail/{produk}", [WelcomeController::class, "produkdetail"])->name("produk-detail");
Route::get("/checkout/{produk}/{price}", [WelcomeController::class, "checkout"])->name("checkout");
//login auth:sellers
Route::group([
    "prefix" => "sellers",
    "middleware" => "is.seller"
], function () {
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
    Route::delete("/product/price/{price}", [PricePackageController::class, "destroy"])->name("product.price.destroy");
    Route::delete("/product/galery/{galery}", [ProductGaleryController::class, "destroy"])->name("product.galery.destroy");
    Route::get("/permintaan", [SellerDashboardController::class, "permintaan"])->name("sellers.permintaan");
    Route::get("/ordering", [SellerDashboardController::class, "ordering"])->name("sellers.ordering");
    Route::get("/permintaan/action/{permintaan}", [SellerDashboardController::class, "permintaanAction"])
        ->name("sellers.permintaan.action");
    Route::get("/penarikan", [SellerDashboardController::class, "penarikan"])->name("sellers.penarikan");
    Route::post("/penarikan", [SellerDashboardController::class, "penarikanPost"])->name("sellers.penarikanPost");
});

Route::group(["middleware" => "is.customer"], function () {
    Route::post("/checkout", [CheckoutController::class, "store"])->name("checkout.store");
    Route::get("/customer/profile", [CustomerController::class, "edit"])->name("customer.edit");
    Route::put("/customer/profile/{customer}", [CustomerController::class, "update"])->name("customer.update");
    Route::get("/pembayaran", [DetailPembayaranController::class, "index"])->name("detail_pembayaran.index");
    Route::post("/pembayaran/bayar/{checkout}", [CheckoutController::class, 'bukti_bayar'])->name("checkout.bayar");
    Route::get('/pembayaran/{id_transaksi}', [CheckoutController::class, "pembayaran"])->name("pembayaran");
    Route::get('/pembayaran/batal/{checkout}', [DetailPembayaranController::class, "batal_pesanan"])->name("customer.batal.pesanan");
    Route::get('/notifikasi', [DetailPembayaranController::class, "notifikasi"])->name("customer.notifikasi");
    Route::put("/notifikasi/{notifikasi}", [DetailPembayaranController::class, "dibaca"])->name("customer.notifikasi.dibaca");
    Route::delete("/notifikasi/{notifikasi}", [DetailPembayaranController::class, "delete_notifikasi"])->name("customer.notifikasi.hapuse");
});

Route::group(["prefix" => "admin", "middleware" => 'is.admin'], function () {
    //route get admin controller
    Route::get("/", [DashboardController::class, "index"])->name("admin");
    Route::get("/kas", [DashboardController::class, "kas"])->name("admin.kas");
    Route::get("/setting", [AdminSettingController::class, "index"])->name("admin.setting.index");
    Route::put("/setting/{adminsetting}", [AdminSettingController::class, "update"])->name("admin.setting.update");
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
    Route::resource('/users', UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'show' => 'admin.users.show',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
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
    Route::group(["prefix" => "transaksi"], function () {
        Route::get("/", [TransaksiController::class, "index"])->name("admin.transaksi");
        Route::get("/ordering", [TransaksiController::class, "ordering"])->name("admin.transaksi.ordering");
        Route::get("/refund", [TransaksiController::class, "refund"])->name("admin.transaksi.refund");
        Route::post("/refund/{refund}", [TransaksiController::class, "refundUpdate"])->name("admin.transaksi.refund.update");
        Route::get("/verifikasi/{transaksi}", [TransaksiController::class, "verifikasi"])->name("admin.transaksi.verifikasi");
    });
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
