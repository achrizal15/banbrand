<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\PricePackage;
use App\Models\Product;
use App\Models\ProductGalery;
use Illuminate\Http\Request;

class PricePackageController extends Controller
{
    private $action_type = ["CREATE", "EDIT"];
    public function index(Product $product)
    {
        $price = PricePackage::where(["produk_id" => $product->id])->with("produkgaleries")->get();
        return view("das.seller.priceproduk.index", ["title" => "Price $product->nama", "produk" => $product, "price" => $price]);
    }
    public function action(Product $product, Request $request)
    {
        $action = strtoupper($request->type);
        if (!in_array($action, $this->action_type)) {
            abort("404");
        }
        switch ($action) {
            case "EDIT":
                return  $this->edit($product, $request);
                break;
            default:
                return  $this->create($product, $request);
                break;
        }
    }
    private function create($product, $request)
    {
        return view("das.seller.priceproduk.form", ["title" => "Price Produk Form", "url" => route("product.price.store"), "produk" => $product]);
    }
    private function edit($product, $request)
    {
        $id = $request->id;
        if (empty($id)) {
            abort(404);
        }
        $price = PricePackage::with("produkgaleries")->find($id);
        return view("das.seller.priceproduk.form", [
            "title" => "Price Produk Form",
            "url" => route("product.price.update", $id),
            "produk" => $product,
            "price" => $price
        ]);
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            "nama" => "required",
            "deskripsi" => "required",
            "produk_id" => "required",
            "harga" => "required",
            "galerys" => "required"
        ]);
        $galerys = $request->file("galerys");
        $price =  PricePackage::create($validate);
        foreach ($galerys as $key => $value) {
            $value->store("public/produk-image");
            ProductGalery::create([
                "nama" => $value->hashName(),
                "entity_id" => $price->id
            ]);
        }
        $response = [
            "message" => "Berhasil",
            "url" => route("product.price", ["product" => $request->produk_id])
        ];
        echo json_encode($response);
    }
    public function destroy(PricePackage $price)
    {
        $response = [
            "message" => "$price->nama Deleted Successfully",
            "url" => route("product.price", $price->produk_id)
        ];
        $galery = new ProductGalery;
        $galery->where("entity_id", $price->id)->delete();
        $price->deleteOrFail();
        echo json_encode($response);
    }
    public function update(PricePackage $price, Request $request)
    {
    
        $option = [
            "nama" => "required",
            "deskripsi" => "required",
            "produk_id" => "required",
            "harga" => "required",
            "status"=>"required"
        ];


        if ($request->old_image == null) {
            $option["galerys"] = "required";
        }

        if ($request->nama == "Custom") {
            unset($option["galerys"]);
        }
        $validate = $request->validate($option);
        $price->update($validate);
        $galerys = $request->file("galerys");
        if ($galerys != null) {
            foreach ($galerys as $key => $value) {
                $value->store("public/produk-image");
                ProductGalery::create([
                    "nama" => $value->hashName(),
                    "entity_id" => $price->id
                ]);
            }
        }
        $response = [
            "message" => "Berhasil",
            "url" => route("product.price", ["product" => $request->produk_id])
        ];
        echo json_encode($response);
    }
}
