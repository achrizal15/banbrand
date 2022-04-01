<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\PricePackage;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Product::latest()->with(["seller", "kategori"])->get();
        return view("das.seller.produk.index", ["title" => "Produk", "produks" => $produk]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoris = ProductCategory::orderBy("nama", "asc")->get();
        return view("das.seller.produk.form", ["title" => "Form produk", "url" => route('sellers.product.store'), "kategoris" => $kategoris]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            "nama" => "required",
            "seller_id" => "required",
            "category_id" => "required",
            "deskripsi" => "required",
            "thumnail" => "required|file"
        ]);
        $request->file("thumnail")->store("public/produk-image");
        $validate["thumnail"] = $request->file("thumnail")->hashName();
        $produk = new Product;
        $produk = $produk->create($validate);
        $data_price_packages = [
            "nama" => "Custom",
            "produk_id" => $produk->id,
            "deskripsi" => "Pastikan anda mengirim file yang dibutuhkan dengan jelas",
            "harga" => "200000",
            "status" => "off"
        ];
        PricePackage::create($data_price_packages);
        $response = [
            "message" => "Berhasil",
            "url" => route("sellers.product.index")
        ];
        echo json_encode($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404, "PAGE SHOW TIDAK DITAMPILKAN");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $kategoris = ProductCategory::orderBy("nama", "asc")->get();
        return view("das.seller.produk.form", [
            "title" => "Form Product",
            "kategoris" => $kategoris,
            "url" => route('sellers.product.update', $product->id),
            "produk" => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
