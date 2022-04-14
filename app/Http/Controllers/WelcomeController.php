<?php

namespace App\Http\Controllers;

use App\Models\PricePackage;
use App\Models\Product;
use App\Models\Seller;

class WelcomeController extends Controller
{
    public function index()
    {
        $produk = Product::orderBy("nama", "ASC")->with(["seller", "kategori"])->get();
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
        return view("detail_produk", ["title" => $produk->nama, "produk" => $produk, "subtitle" => "produk"]);
    }
    public function checkout(Product $produk, PricePackage $price)
    {
        if ($price->produk_id != $produk->id) {
            abort(404);
        }
        return view("checkout", ["title" => "Checkout", "produk" => $produk, "price" => $price,"subtitle" => "checkout"]);
    }
}
