<?php

namespace App\Http\Controllers;

use App\Models\AdminSetting;
use App\Models\checkout;
use App\Models\PricePackage;
use App\Models\Product;
use App\Models\Refund;
use App\Models\Seller;

class WelcomeController extends Controller
{

    public function index()
    {
        $produk = Product::orderBy("nama", "ASC")->with(["seller", "kategori", "checkout"])->get();
        // dd(auth()->user());
        $checkout =  new checkout();
        // $checkout->update(["status" => "Expired"], ["expired_at <=" => now()]);
        $checkout->where("status", "Belum Dibayar")
            ->where("expired_at", "<=", now())
            ->update(["status" => "Expired"]);
        $checkoutDibayar = checkout::latest()->where("status", "Proses")->where("expired_at", "<=", now())->get();
        foreach ($checkoutDibayar as $item) {
            Refund::create([
                "checkout_id" => $item->id,
                "no_rekening" => $item->no_rekening,
                "keterangan" => "Pembatalan pesanan",
                "saldo" => $item->harga * $item->qty, "type" => "refund"
            ]);
        }
        return view("welcome", ["title" => "BANBRAND", "produk" => $produk]);
    }
    public function toko(Seller $toko)
    {
        $produk = Product::orderBy("nama", "ASC")->where("seller_id", $toko->id)->with(["seller", "kategori", "priceproduk"])->whereHas("priceproduk", function ($e) {
            $e->where("status", "on");
        })->get();

        return view("toko", ["title" => $toko->nama, "toko" => $toko, "subtitle" => $toko->nama_toko, "produk" => $produk]);
    }
    public function produkdetail(Product $produk)
    {
        $produk = $produk->load(["seller", "kategori", "priceproduk", "priceproduk.produkgaleries"]);
        $user = auth("customers")->user();
        return view("detail_produk", ["title" => $produk->nama, "produk" => $produk, "subtitle" => "produk", "user" => $user]);
    }
    public function checkout(Product $produk, PricePackage $price)
    {
        $user = auth("customers")->user();
        if ($price->produk_id != $produk->id || $user == null) {
            abort(404);
        }
        $setting = AdminSetting::latest()->get();

        return view("checkout", ["title" => "Checkout", "produk" => $produk->load("seller"), "price" => $price->load("produkgaleries"), "subtitle" => "checkout ($price->nama)", "user" => $user, 'setting' => $setting[0]]);
    }
}
